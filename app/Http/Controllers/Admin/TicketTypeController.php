<?php

namespace App\Http\Controllers\Admin;

use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  // Assure-toi d'ajouter cette ligne


class TicketTypeController extends Controller
{
    public function index()
    {
        $ticketTypes = TicketType::all();
        return view('admin.ticket_types.index', compact('ticketTypes'));
    }

    public function create()
    {
        return view('admin.ticket_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'available_seats' => 'required|integer',

        ]);

        TicketType::create([
        'name' => $request->name,
        'price' => $request->price,
        'available_seats' => $request->available_seats,
        // Pas d'image ici
    ]);

        return redirect()->route('admin.ticket-types.index')->with('success', 'Type de billet ajouté avec succès.');
    }

    public function edit(TicketType $ticketType)
    {
        return view('admin.ticket_types.edit', compact('ticketType'));
    }

    public function update(Request $request, TicketType $ticketType)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $ticketType->update($request->all());

        return redirect()->route('admin.ticket-types.index');
    }

    public function destroy(TicketType $ticketType)
    {
        $ticketType->delete();

        return redirect()->route('admin.ticket-types.index');
    }
}
