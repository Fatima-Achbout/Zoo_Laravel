@extends('layouts.appAdmin')

@section('content')
<div class="max-w-xl mx-auto p-4">

    <h1 class="text-2xl font-bold mb-6">Ajouter un utilisateur</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block">Nom</label>
            <input type="text" name="name" class="w-full px-4 py-2 border rounded" required>
            @error('name') <span>{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 border rounded" required>
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block">Mot de passe</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
