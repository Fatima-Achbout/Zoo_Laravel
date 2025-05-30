<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    protected $fillable = ["order_id","ticket_id","quantity","price", "visit_date"];

     public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public static function soldTickets()
{
    return self::whereHas('order', function ($query) {
        $query->where('status', 'sold');
    })->with('ticket')->get();
}



}