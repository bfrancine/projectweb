<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FriendController extends Controller
{
    // Mostrar todos los amigos (método existente)
    public function index()
    {
        return response()->json(Friend::all(), 200);
    }

    // Mostrar un amigo específico por ID (método existente)
    public function show($id)
    {
        $friend = Friend::find($id);
        if (!$friend) {
            return response()->json(['message' => 'Friend not found'], 404);
        }
        return response()->json($friend, 200);
    }

    // Mostrar la lista de árboles del amigo (método existente)
    public function listTrees($friend_id)
    {
        // Obtén los árboles asociados con el amigo
        $trees = Tree::where('friend_id', $friend_id)->get();

        // Retorna la vista con los árboles obtenidos
        return view('friend.list_trees', compact('trees', 'friend_id'));
    }

    // Mostrar el menú de amigos (método existente)
    public function showFriendMenu()
    {
        return view('friend_menu');
    }

    // Mostrar formulario de registro de amigo
    public function showRegisterForm()
    {
        return view('auth.register_friend'); // Asegúrate de tener la vista correspondiente
    }

    // Método de logout (método existente)
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }


    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:friends,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el amigo
        $friend = new Friend();
        $friend->user_id = auth()->user()->id; // Si el amigo está asociado con un usuario autenticado
        $friend->first_name = $request->first_name;
        $friend->last_name = $request->last_name;
        $friend->phone_number = $request->phone_number;
        $friend->email = $request->email;
        $friend->address = $request->address;
        $friend->password = Hash::make($request->password); // Encriptar la contraseña
        $friend->save();

        // Redirigir con éxito
        return redirect()->route('friend.register.form')->with('success', 'Friend registered successfully!');
    }

}
