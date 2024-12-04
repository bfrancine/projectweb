<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Models\Tree;
use App\Models\TreeHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Storage;

class TreeController extends Controller
{
    /**
     * Display a listing of all trees with their species and owner information
     * 
     * @return \Illuminate\View\View Returns view with trees and available species
     */
    public function index()
    {
        $trees = Tree::with(['species', 'owner'])
            ->orderBy('created_at', 'desc')
            ->get();
        $species = Species::all();
        return view('admin.trees.index', compact('trees', 'species'));
    }

    /**
     * Store a new tree record and its initial history
     * 
     * @param \Illuminate\Http\Request $request The incoming request with tree data:
     *                                         - species_id
     *                                         - location
     *                                         - price
     *                                         - photo
     *                                         - size
     * @return \Illuminate\Http\RedirectResponse Redirects to tree list after creation
     * 
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'species_id' => 'required|exists:species,id',
            'location' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'required|image',
            'size' => 'required|numeric',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('trees', 'public');
        }

        $tree = Tree::create($validated);

        TreeHistory::create([
            'tree_id' => $tree->id,
            'size' => $validated['size'],
            'photo' => $validated['photo'],
        ]);

        return redirect()->route('trees.index')->with('success', 'Tree created successfully');
    }


    /**
     * Update an existing tree's information
     * 
     * @param \Illuminate\Http\Request $request The incoming request with updated tree data:
     *                                         - species_id
     *                                         - location
     *                                         - status
     *                                         - price (optional)
     *                                         - photo (optional)
     *                                         - size
     * @param \App\Models\Tree $tree The tree instance to update
     * @return \Illuminate\Http\RedirectResponse Redirects to tree list after update
     * 
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function update(Request $request, Tree $tree)
    {
        $validated = $request->validate([
            'species_id' => 'required|exists:species,id',
            'location' => 'required|string',
            'status' => 'required|in:available,sold',
            'price' => 'sometimes|numeric',
            'photo' => 'sometimes|image',
            'size' => 'required|numeric',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('trees', 'public');
        }

        $tree->update($validated);
        return redirect()->route('trees.index')->with('success', 'Tree updated successfully');
    }

    /**
     * Update a friend's tree information
     * 
     * @param \Illuminate\Http\Request $request The request with tree update data
     * @param \App\Models\User $friend The friend who owns the tree
     * @param \App\Models\Tree $tree The tree to update
     * @return \Illuminate\Http\RedirectResponse Back to previous page with status
     * 
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function updateFriendTree(Request $request, User $friend, Tree $tree)
    {
        if ($tree->owner_id !== $friend->id) {
            return back()->with('error', 'This tree does not belong to this friend');
        }

        $validated = $request->validate([
            'size' => 'required|numeric|min:0',
            'species_id' => 'required|exists:species,id',
            'location' => 'required|string',
            'status' => 'required|in:available,sold',
        ]);

        $tree->update($validated);

        return back()->with('success', 'Tree information updated successfully');
    }

    /**
     * Remove a tree and its associated photo from storage
     * 
     * @param \App\Models\Tree $tree The tree to delete
     * @return \Illuminate\Http\RedirectResponse Redirects to tree list after deletion
     */
    public function destroy(Tree $tree)
    {
        if ($tree->photo && Storage::disk('public')->exists($tree->photo)) {
            Storage::disk('public')->delete($tree->photo);
        }

        $tree->delete();

        return redirect()->route('trees.index')
            ->with('success', 'Tree deleted successfully');
    }

    public function listPurchasedTrees()
    {
        $trees = Tree::where('status', 'sold')
            ->with(['owner', 'species'])
            ->get();
        return view('operator.trees.index', compact('trees'));
    }

    public function listFriendTrees(User $friend)
    {
        if ($friend->role !== 'friend') {
            return redirect()->route('friends.index')
                ->with('error', 'Invalid user role');
        }

        $trees = Tree::where('owner_id', $friend->id)
            ->with(['species', 'owner'])
            ->get();

        $species = Species::all();

        return view('admin.friends.trees', compact('friend', 'trees', 'species'));
    }
}
