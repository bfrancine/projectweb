<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Models\Friend;
use App\Models\Tree;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra la vista de especies
    public function showSpecies()
    {
        $species = Specie::all();
        return view('admin.species.index', compact('species'));
    }

    // Muestra la vista de amigos
    public function showFriends()
    {
        $friends = Friend::all();
        return view('admin.friends.index', compact('friends'));
    }

    // Muestra la vista de árboles
    public function showTrees()
    {
        $trees = Tree::all();
        return view('admin.trees.index', compact('trees'));
    }

    public function showAdminMenu()
    {
        return view('admin_menu');
    }
    // Log out (esto dependerá de tu configuración de autenticación)
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
