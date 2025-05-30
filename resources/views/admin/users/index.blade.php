@extends('layouts.appAdmin')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <a href="{{ route('admin.users.create') }}" class="bg-green-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-green-700 transition duration-300 ease-in-out">
        Ajouter un utilisateur
    </a>
</div>

<h1 class="text-2xl font-bold mb-6">Liste des Utilisateurs</h1>

<!-- Tableau des utilisateurs -->
<div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Nom</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Email</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-b">
                    <td class="px-4 py-2 text-sm">{{ $user->name }}</td>
                    <td class="px-4 py-2 text-sm">{{ $user->email }}</td>
                    <td class="px-4 py-2 text-sm flex space-x-4">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
