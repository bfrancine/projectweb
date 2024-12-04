<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Tree;
use App\Models\Friend;
use Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request, Tree $tree)
    {
        // Validate tree is available
        if ($tree->status !== 'available') {
            return back()->with('error', 'This tree is no longer available');
        }

        try {
            // Create purchase record
            $purchase = Purchase::create([
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

            // Redirect with success message
            return redirect()->route('friend.available-trees')
                ->with('success', 'Tree purchased successfully! You can view it in your trees section.');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'There was an error processing your purchase. Please try again.');
        }
    }
}
