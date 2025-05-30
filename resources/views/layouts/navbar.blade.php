<!-- resources/views/layouts/navbar.blade.php -->
<nav class="bg-green-800 p-4">
    <div class="flex justify-between items-center max-w-screen-xl mx-auto">
        <div class="text-white font-bold">ZooPanel</div>
        <div class="flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="text-white">Utilisateurs</a>
            <a href="{{ route('admin.tickets.index') }}" class="text-white">Billets</a>
            <a href="{{ route('admin.animals.index') }}" class="text-white">Animaux</a>
        </div>
    </div>
</nav>
