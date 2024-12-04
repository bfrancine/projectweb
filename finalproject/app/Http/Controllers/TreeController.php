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
    public function index()
    {
        $trees = Tree::with(['species', 'owner'])->get();
        $species = Species::all();
        return view('admin.trees.index', compact('trees', 'species'));
    }

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
