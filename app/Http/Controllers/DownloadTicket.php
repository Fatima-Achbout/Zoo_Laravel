<?php

namespace App\Http\Controllers;

use App\Models\Order;        // Import your Order model
use Barryvdh\DomPDF\Facade\Pdf;  // Import the PDF facade with the correct namespace
use Illuminate\Http\Request;

class DownloadTicket extends Controller
{
    public function downloadTicket($orderId)
{
    $order = Order::with('tickets.ticket')->findOrFail($orderId);

    $pdf = Pdf::loadView('tickets.download', compact('order'));

    return $pdf->download('ticket_'.$order->id.'.pdf');
}

}