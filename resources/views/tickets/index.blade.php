@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Liste des Tickets</h1>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">NOM</th>
                <th class="px-4 py-2">PRIX</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td class="px-4 py-2">{{ $ticket->id }}</td>
                    <td class="px-4 py-2">{{ $ticket->type }}</td>
                    <td class="px-4 py-2">{{ number_format($ticket->price, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
