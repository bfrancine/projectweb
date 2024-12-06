<?php

namespace App\Http\Controllers;

use App\Models\TreeHistory;
use App\Models\User;
use App\Models\Tree;
use Auth;

/**
 * Handles dashboard functionality for different user roles
 * Provides role-specific views and statistics for admins, operators, and friends
 */
class DashboardController extends Controller
{
    /**
     * Redirects users to their role-specific dashboard based on their role
     * Unauthorized users are redirected to login page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'operator' => redirect()->route('operator.dashboard'),
            default => redirect()->route('friend.dashboard'),
        };
    }

    /**
     * Displays admin dashboard with overview statistics
     * Shows counts of friends, available trees, and sold trees
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        $stats = [
            'friends_count' => User::where('role', 'friend')->count(),
            'available_trees' => Tree::where('status', 'available')->count(),
            'sold_trees' => Tree::where('status', 'sold')->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Displays operator dashboard with metrics and recent tree updates
     * Shows friend count, available trees, and latest tree history
     *
     * @return \Illuminate\View\View
     */
    public function operatorDashboard()
    {
        $stats = [
            'friends_count' => User::where('role', 'friend')->count(),
            'available_trees' => Tree::where('status', 'available')->count(),
        ];

        $recentUpdates = TreeHistory::with(['tree.owner'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('operator.dashboard', compact('stats', 'recentUpdates'));
    }

    /**
     * Displays friend dashboard showing their trees and available trees
     * Shows count of owned trees, available trees, and recent tree list
     *
     * @return \Illuminate\View\View Returns friend dashboard view with tree statistics and list
     */
    public function friendDashboard()
    {
        $user = auth()->user();
        $stats = [
            'my_trees' => Tree::where('owner_id', $user->id)->count(),
            'available_trees' => Tree::where('status', 'available')->count(),
        ];

        $myTrees = Tree::where('owner_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('friend.dashboard', compact('stats', 'myTrees'));
    }
}
