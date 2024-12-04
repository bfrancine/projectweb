<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreeHistory;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{

    public function myTrees()
    {
        $trees = Tree::where('owner_id', Auth::id())->with('species')->get();
        return view('friend.my-trees', compact('trees'));
    }

    public function availableTrees()
    {
        $trees = Tree::where('status', 'available')
            ->with('species')
            ->get();
        return view('friend.available-trees', compact('trees'));
    }

    public function index()
    {
        $friends = User::where('role', 'friend')
            ->withCount('trees')
            ->get();
        return view('admin.friends.index', compact('friends'));
    }

    public function show(User $friend)
    {
        if ($friend->role !== 'friend') {
            return redirect()->route('friends.index')->with('error', 'Invalid user type');
        }

        $trees = $friend->trees()->with(['species', 'latestUpdate'])->get();
        return view('admin.friends.show', compact('friend', 'trees'));
    }

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

        // Guardar la imagen
        $imagePath = $request->file('image')->store('tree-updates', 'public');

        TreeHistory::create([
            'tree_id' => $tree->id,
            'size' => $validated['size'],
            'image' => $imagePath,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Tree update recorded successfully');
    }

    public function treeHistory(User $friend, Tree $tree)
    {
        if ($tree->owner_id !== $friend->id) {
            return redirect()->back()->with('error', 'This tree does not belong to this friend');
        }

        $updates = $tree->updates()->orderByDesc('created_at')->get();
        return view('admin.friends.tree-history', compact('friend', 'tree', 'updates'));
    }
}
