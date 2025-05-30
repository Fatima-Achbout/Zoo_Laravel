<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'ticket_type_id', 'price', 'status'];


public function acheterBillet(Request $request)
{
    // 1. Valider et créer le billet (exemple simplifié)
    $ticket = Ticket::create([
        'user_id' => auth()->id(),
        'ticket_type_id' => $request->ticket_type_id,
        'status' => 'sold',
        'price' => $request->price,
    ]);

    // 2. Créer la transaction liée
    Transaction::create([
        'user_id' => auth()->id(),
        'ticket_type_id' => $request->ticket_type_id,
        'price' => $request->price,
        'status' => 'paid',
    ]);

    // Redirection ou réponse JSON, etc.
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
