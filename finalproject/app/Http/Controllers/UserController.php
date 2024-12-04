<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of administrative users (admins and operators)
     * Excludes users with 'friend' role from the listing
     * 
     * @return \Illuminate\View\View Returns view with list of administrative users
     */
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'operator'])->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a new administrative user in the system
     * 
     * @param \Illuminate\Http\Request $request The incoming request with user data:
     *                                         - first_name
     *                                         - last_name
     *                                         - email
     *                                         - password (min 8 chars, needs confirmation)
     *                                         - role (admin/operator)
     * @return \Illuminate\Http\RedirectResponse Redirects to users list after creation
     * 
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,operator',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Update an existing user's information
     * Allows password update as optional field
     * 
     * @param \Illuminate\Http\Request $request The incoming request with updated user data:
     *                                         - first_name
     *                                         - last_name
     *                                         - email (must remain unique)
     *                                         - role (admin/operator)
     *                                         - password: Optional new password (with confirmation)
     * @param \App\Models\User $user The user instance to update
     * @return \Illuminate\Http\RedirectResponse Redirects to users list after update
     * 
     * @throws \Illuminate\Validation\ValidationException When validation fails
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,operator',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove a user from the system
     * 
     * @param \App\Models\User $user The user to delete
     * @return \Illuminate\Http\RedirectResponse Redirects to users list with status message
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
