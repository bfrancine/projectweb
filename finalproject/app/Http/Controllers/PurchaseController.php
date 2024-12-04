<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Tree;
use Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Store a new purchase record for a tree
     * 
     * @param \Illuminate\Http\Request $request The incoming HTTP request object
     * @param \App\Models\Tree $tree The tree model instance to be purchased
     * 
     * @throws \Exception When database operations fail
     * @return \Illuminate\Http\RedirectResponse Returns redirect response with success/error message
     */
    public function store(Request $request, Tree $tree)
    {
        if ($tree->status !== 'available') {
            return back()->with('error', 'This tree is no longer available');
        }

        try {
            Purchase::create([
                'tree_id' => $tree->id,
                'user_id' => Auth::id(),
                'amount' => $tree->price,
                'purchase_date' => now(),
            ]);

            // Update tree status and owner
            $tree->update([
                'status' => 'sold',
                'owner_id' => Auth::id()
            ]);

            return redirect()->route('friend.available-trees')
                ->with('success', 'Tree purchased successfully! You can view it in your trees section.');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'There was an error processing your purchase. Please try again.');
        }
    }
}
