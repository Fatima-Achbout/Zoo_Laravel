<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\User; // Modèle pour les utilisateurs
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Transaction;  // <-- ajoute cette ligne


class DashboardController extends Controller
{
    public function index()
{
    // Récupérer les commandes payées
    $orders = Order::where('status', 1)
        ->with(['user', 'orderTickets.ticket']) // si tu as ces relations
        ->latest()
        ->take(30) 
        ->get();




        $orders->transform(function ($order) {
        $groupedTickets = $order->orderTickets->groupBy(function ($item) {
            return $item->ticket->type ?? 'Non défini';
        });

        $order->groupedTickets = $groupedTickets->map(function ($group) {
            return [
                'type' => $group->first()->ticket->type ?? 'Non défini',
                'quantity' => $group->sum('quantity'),
            ];
        })->values();

        return $order;
    });
    // Autres statistiques (optionnel)
    $totalUsers = \App\Models\User::count();
    $totalTicketsSold = DB::table('order_tickets')
        ->join('orders', 'order_tickets.order_id', '=', 'orders.id')
        ->where('orders.status', 1)
        ->sum('order_tickets.quantity');

    // Calculer total revenue (somme amount des commandes payées)
    $totalRevenue = Order::where('status', 1)->sum('amount');
    $totalTickets = \App\Models\Ticket::count();

    return view('welcome', compact(
        'orders',
        'totalUsers',
        'totalTicketsSold',
        'totalRevenue',
        'totalTickets'
    ));
}

public function dashboard()
{
    $paidOrders = Order::where('status', 1)
        ->with(['user', 'ticket']) // relations utiles
        ->latest()
        ->paginate(10);  

    return view('admin.dashboard', compact('paidOrders'));
}

}