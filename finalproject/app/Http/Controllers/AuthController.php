<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login'); // Vista del formulario de login
    }

    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Redirigir según el rol del usuario
        if ($user->type_user === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->type_user === 'friend') {
            return redirect()->route('friend.dashboard');
        }
    }

    // Si las credenciales son incorrectas
    return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Manejar el logout
    public function logout()
    {
        Auth::logout(); // Cerrar sesión
        return redirect()->route('login'); // Redirigir al formulario de login
    }
}

