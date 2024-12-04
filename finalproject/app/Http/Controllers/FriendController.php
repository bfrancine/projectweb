<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreeHistory;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

/**
 * Handles friend-related functionality including tree management and history
 */
class FriendController extends Controller
{

    /**
     * Display trees owned by the authenticated user
     * 
     * @return \Illuminate\View\View Returns view with user's trees and their species
     */
    public function myTrees()
    {
        $trees = Tree::where('owner_id', Auth::id())->with('species')->get();
        return view('friend.my-trees', compact('trees'));
    }

    /**
     * Display all available trees
     * 
     * @return \Illuminate\View\View Returns view with list of available trees
     */
    public function availableTrees()
    {
        $trees = Tree::where('status', 'available')
            ->with('species')
            ->get();
        return view('friend.available-trees', compact('trees'));
    }

    /**
     * Display list of all friends with their tree counts
     * 
     * @return \Illuminate\View\View Returns view with list of friends and statistics
     */
    public function index()
    {
        $friends = User::where('role', 'friend')
            ->withCount('trees')
            ->get();
        return view('admin.friends.index', compact('friends'));
    }

    /**
     * Display detailed information about a specific friend
     * 
     * @param User $friend The friend user to display
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Returns view with friend details or redirects if invalid
     */
    public function show(User $friend)
    {
        if ($friend->role !== 'friend') {
            return redirect()->route('friends.index')->with('error', 'Invalid user type');
        }

        $trees = $friend->trees()->with(['species', 'latestUpdate'])->get();
        return view('admin.friends.show', compact('friend', 'trees'));
    }

    /**
     * Update tree information for a specific friend
     * 
     * @param Request $request The HTTP request containing tree data
     * @param User $friend The owner of the tree
     * @param Tree $tree The tree to update
     * @return \Illuminate\Http\RedirectResponse Returns redirect with success/error message
     */
    public function updateTree(Request $request, User $friend, Tree $tree)
    {
        if ($tree->owner_id !== $friend->id) {
            return redirect()->back()->with('error', 'This tree does not belong to this friend');
        }

        $validated = $request->validate([
            'size' => 'required|numeric',
            'species_id' => 'required|exists:species,id',
            'location' => 'required|string',
            'status' => 'required|in:available,sold',
        ]);

        $tree->update($validated);

        return redirect()->back()->with('success', 'Tree updated successfully');
    }

    /**
     * Store a new record for the friend's tree history
     * 
     * @param Request $request The HTTP request containing update data
     * @param User $friend The owner of the tree
     * @param Tree $tree The tree being updated
     * @return \Illuminate\Http\RedirectResponse Returns redirect with success/error message
     */
    public function storeTreeUpdate(Request $request, User $friend, Tree $tree)
    {
        if ($tree->owner_id !== $friend->id) {
            return redirect()->back()->with('error', 'This tree does not belong to this friend');
        }

        $validated = $request->validate([
            'size' => 'required|numeric',
            'image' => 'required|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('tree-history', 'public');

        TreeHistory::create([
            'tree_id' => $tree->id,
            'size' => $validated['size'],
            'image' => $imagePath,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Tree update recorded successfully');
    }

    /**
     * Display the history of updates for a friend's tree
     * 
     * @param User $friend The owner of the tree
     * @param Tree $tree The tree to show history for
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Returns view with tree history or redirects if invalid
     */
    public function treeHistory(User $friend, Tree $tree)
    {
        if ($tree->owner_id !== $friend->id) {
            return redirect()->back()->with('error', 'This tree does not belong to this friend');
        }

        $updates = $tree->updates()->orderByDesc('created_at')->get();
        return view('admin.friends.tree-history', compact('friend', 'tree', 'updates'));
    }
}
