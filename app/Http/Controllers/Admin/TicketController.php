<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket; // Si tu as un modèle Ticket
use App\Models\TicketAvailability;
use App\Models\Transaction; // إذا عندك موديل المعاملات (transactions)


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all(); // Remplace par la logique pour récupérer les billets
        return view('admin.tickets.index', compact('tickets'));
    }

    public function acheterBillet(Request $request)
{
    $availability = TicketAvailability::where('ticket_type_id', $request->ticket_id)
                    ->where('date', $request->date)
                    ->first();

    if (!$availability) {
        return back()->withErrors('Ticket non disponible pour ce jour.');
    }

    if ($availability->available_quantity <= 0) {
        return back()->withErrors('Plus de places disponibles pour ce jour.');
    }

    $availability->decrement('available_quantity');

    Transaction::create([
        'ticket_type_id' => $request->ticket_id,
        'price' => $availability->ticketType->price,
        'status' => 'paid',


        'buyer_name' => $request->buyer_name ?? null,
        'buyer_email' => $request->buyer_email ?? null,
    ]);

    return redirect()->route('admin.tickets.index')->with('success', 'Billet acheté avec succès.');

}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
