<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['type', 'price'];
    public function orderTickets() 
{
    return $this->hasMany(OrderTicket::class);
}
}