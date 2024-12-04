<?php

namespace App\Http\Controllers;

use App\Models\TreeHistory;
use App\Models\User;
use App\Models\Tree;
use Auth;

class DashboardController extends Controller
{
    /**
     * Redirects users to their role-specific dashboard
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
     * Display admin dashboard with overview statistics
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
     * Display operator dashboard with relevant metrics and recent updates
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
