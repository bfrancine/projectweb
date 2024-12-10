<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\TreeHistory;
use Illuminate\Http\Request;

class TreeHistoryController extends Controller
{
    /**
     * Store a new growth record for a tree
     * Records both the new size measurement and a current photo of the tree
     * Updates the tree's current size and photo after recording history
     *
     * @param \Illuminate\Http\Request $request The incoming request with update data:
     *                                         - size: Current size of the tree
     *                                         - photo: New photo showing tree's current state
     * @param \App\Models\Tree $tree The tree to record history for
     * @return \Illuminate\Http\RedirectResponse Redirects back with success message
     *
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function store(Request $request, Tree $tree)
    {
        $validated = $request->validate([
            'size' => 'required|numeric',
            'photo' => 'required|image',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('tree-history', 'public');
        }

        TreeHistory::create([ //cuenta como un select 
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

    /**
     * Display the growth history of a specific tree
     * Shows all recorded size changes and photos in chronological order
     *
     * @param \App\Models\Tree $tree The tree whose history to display
     * @param \Illuminate\Http\Request $request Contains optional parameters:
     *                                         - from: Title of the previous page for navigation
     * @return \Illuminate\View\View Returns view with tree history and navigation context
     */
    public function history(Tree $tree, Request $request)
    {
        $previousTitle = $request->get('from', 'Manage Trees'); //trae de la URL
        $updates = $tree->updates()->orderBy('created_at', 'desc')->get(); 
        return view('tree-history.index', compact('tree', 'updates', 'previousTitle'));
    }
}
