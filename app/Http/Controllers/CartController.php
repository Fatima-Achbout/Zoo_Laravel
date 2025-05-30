<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;



class CartController extends Controller
{
    // Affiche la liste des offres disponibles
    public function showOffers()
    {
        $tickets = Ticket::all();
        return view('tickets.offers', compact('tickets'));
    }

    // Ajouter un ticket au panier
    public function addToCart(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'visit_date' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addDays(20)->toDateString(),
            'quantity' => 'required|integer|min:1'
        ]);

        $ticket = Ticket::find($request->ticket_id);

        $cart = session()->get('cart', []);

        $cart[] = [
            'ticket_id' => $ticket->id,
            'type' => $ticket->type,
            'price' => $ticket->price,
            'visit_date' => $request->visit_date,
            'quantity' => $request->quantity
        ];

        session()->put('cart', $cart);
        // dd(session('cart'));
        return redirect()->route('cart.show')->with('success', 'Ticket ajouté au panier.');
    }

    // Afficher le panier
    public function showCart()
    {
        $cart = session()->get('cart', []);
        // dd($cart);
        return view('tickets.cart', compact('cart'));
    }

    // Supprimer un élément du panier par son index
    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);
        unset($cart[$index]);
        session()->put('cart', array_values($cart));

        return redirect()->route('cart.show')->with('success', 'Ticket ajouté au panier.');
    }

    // Procéder au paiement (placeholder)
    public function checkout()
    {
         $cart = session()->get('cart', []);
        $totalGeneral = 0;

        foreach ($cart as $item) {
            $totalGeneral += $item['price'] * $item['quantity'];
        }

        return view('form', compact('totalGeneral'));
    }

    public function order(Request $request){
        $order = Order::create([
            "user_id" => Auth::id(),
            'amount' => 0,

        ]);
        $totalAmount = 0;

    foreach(session('cart') as $item){
        $order->tickets()->create([
            'ticket_id' => $item['ticket_id'], // use ticket_id here, not $key
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'visit_date' => $item['visit_date'], // pass visit date from cart/session
        ]);

        $totalAmount += $item['quantity'] * $item['price'];
    }

    // Update order total
    $order->amount = $totalAmount;
    $order->save();
        
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    
    $successURL = route('order.success').'?session_id={CHECKOUT_SESSION_ID}&order_id='.$order->id;

    $response = $stripe->checkout->sessions->create([
        'success_url' => $successURL,
        "customer_email" => Auth::user()->email,

        'line_items' => [
            [
            'price_data' => [
                "product_data"=>[
                    "name"=> "Shopping"
                ],
                "unit_amount"=>100 * $totalAmount,
                "currency"=>"MAD"
            ],
            'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        ]);
        return redirect($response['url']);

    
    }

    public function orderSuccess(Request $request){

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
       $session = $stripe->checkout->sessions->retrieve($request->session_id); 
        
       if($session->status == "complete"){
        $order = Order::find($request->order_id);
        $order->status = "1";
        $order->stripe_id = $session->id;
        $order->save();
        session()->forget('cart');


        return redirect()->route("home")->with("Success", "Ticket placed");
        }
        $order = Order::find($request->order_id);
        $order->status = "2";
        
        $order->save();
        dd("faild");
}


}