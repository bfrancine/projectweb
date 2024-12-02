<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\Friend;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchaseTree(Request $request)
    {
        $validatedData = $request->validate([
            'tree_id' => 'required|exists:tree,id',
            'friend_id' => 'required|exists:friends,id',
        ]);

        $tree = Tree::find($validatedData['tree_id']);
        $friend = Friend::find($validatedData['friend_id']);

        if (!$tree || !$friend) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        try {
            $tree->update(['state_tree_id' => 2]); // Suponiendo que '2' es el ID del estado "Vendido"
            $friend->trees()->attach($tree->id);

            return response()->json(['message' => 'Purchase successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error in purchase'], 500);
        }
    }
}
