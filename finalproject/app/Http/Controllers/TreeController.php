<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function index()
    {
        $trees = Tree::with(['specie', 'state'])->get();
        return response()->json($trees, 200);
    }

    public function show($id)
    {
        $tree = Tree::with(['specie', 'state'])->find($id);
        if (!$tree) {
            return response()->json(['message' => 'Tree not found'], 404);
        }
        return response()->json($tree, 200);
    }

    public function availableTrees()
    {
        $trees = Tree::with(['specie', 'state'])
            ->whereHas('state', function ($query) {
                $query->where('type_state', 'Disponible')->orWhere('type_state', 'Available');
            })->get();
        return response()->json($trees, 200);
    }
}

