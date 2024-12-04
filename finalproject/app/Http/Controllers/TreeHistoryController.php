<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreeHistory;
use Illuminate\Http\Request;

class TreeHistoryController extends Controller
{
    public function store(Request $request, Tree $tree)
    {
        $validated = $request->validate([
            'size' => 'required|numeric',
            'photo' => 'required|image',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('tree-updates', 'public');
        }

        TreeHistory::create([
            'tree_id' => $tree->id,
            'size' => $validated['size'],
            'photo' => $validated['photo'],
        ]);

        $tree->update([
            'size' => $validated['size'],
            'photo' => $validated['photo'],
        ]);

        return redirect()->back()->with('success', 'Tree update recorded successfully');
    }

    public function history(Tree $tree)
    {
        $updates = $tree->updates()->orderBy('created_at', 'desc')->get();
        return view('tree-updates.history', compact('tree', 'updates'));
    }
}
