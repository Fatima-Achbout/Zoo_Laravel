<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Affiche le formulaire d’édition d’un utilisateur.
     */
    public function edit(User $user) // Laravel injecte automatiquement l'instance User
{
    return view('admin.users.edit', compact('user'));
}

    /**
     * Met à jour les informations d’un utilisateur.
     */
        public function update(Request $request, User $user) // Laravel injecte automatiquement l'instance User
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        // 'unique' doit ignorer l'utilisateur actuel
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];

    if ($request->filled('password')) {
        $user->password = bcrypt($validatedData['password']);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
}

    /**
     * Supprime un utilisateur.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
