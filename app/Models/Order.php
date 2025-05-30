<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = ['user_id','amount','status','stripe_id'];


    public function orderTickets()
{
    return $this->hasMany(OrderTicket::class);
}
    public function tickets(){
        return $this->hasMany(OrderTicket::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    //  public function Ticket()
    // {
    //     return $this->belongsTo(Ticket::class , 'type');
    // }
}
