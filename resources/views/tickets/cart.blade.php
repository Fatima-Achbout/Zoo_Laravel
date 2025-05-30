@extends('layouts.app')

@section('content')
<div class="zoofari-cart">
    <div class="container">
        <!-- Header -->
        <div class="cart-header">
            <h1>Mon Panier</h1>
            <p class="lead">Récapitulatif de vos billets sélectionnés</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert-message success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <form action="{{ route('order.post') }}" method="POST">
            @csrf

            @php
            $total = 0;
            @endphp

            @if(count($cart) > 0)
            <!-- Cart Table -->
            <div class="cart-table-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $index => $item)
                        @php
                        $ligneTotal = $item['price'] * $item['quantity'];
                        $total += $ligneTotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="ticket-type">
                                    <i class="fas {{ $item['type'] == 'Enfant' ? 'fa-child' : 'fa-user' }}"></i>
                                    <span>{{ $item['type'] }}</span>
                                </div>
                            </td>
                            <td>{{ $item['visit_date'] ?? 'Date non renseignée' }}</td>

                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] }} DHS</td>
                            <td class="price-cell">{{ $ligneTotal }} DHS</td>
                            <td>
                                <a href="{{ route('cart.remove', $index) }}" class="btn-remove">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Total général:</span>
                    <span class="total-price">{{ $total }} DHS</span>
                </div>
            </div>

            <!-- Cart Actions -->
            <div class="cart-actions">
                <a href="{{ route('tickets.offers') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Retour aux offres
                </a>
                @auth
                <button type="submit" class="btn btn-primary">
                    Passer au paiement <i class="fas fa-credit-card"></i>
                </button>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Connectez-vous pour payer <i class="fas fa-sign-in-alt"></i>
                </a>
                @endauth
            </div>

            @else
            <!-- Empty Cart -->
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>Votre panier est vide</h3>
                <p>Vous n'avez pas encore ajouté de tickets à votre panier.</p>
                <a href="{{ route('tickets.offers') }}" class="btn btn-primary">
                    Découvrir nos offres <i class="fas fa-ticket-alt"></i>
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
/* Base Styles */
.zoofari-cart {
    font-family: 'Poppins', sans-serif;
    color: #333;
    padding: 4rem 0;
    background-color: #f8f9fa;
    min-height: 70vh;
}

.zoofari-cart .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Cart Header */
.cart-header {
    text-align: center;
    margin-bottom: 3rem;
}

.cart-header h1 {
    font-size: 2.5rem;
    color: #1e5631;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.cart-header .lead {
    color: #666;
    font-size: 1.1rem;
}

/* Alert Message */
.alert-message {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.alert-message i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.alert-message.success {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
    border-left: 4px solid #28a745;
}

/* Cart Table */
.cart-table-container {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 2rem;
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table th {
    background-color: #f8f9fa;
    color: #1e5631;
    font-weight: 600;
    text-align: left;
    padding: 1.2rem 1rem;
    font-size: 1rem;
}

.cart-table td {
    padding: 1.2rem 1rem;
    border-bottom: 1px solid #f1f1f1;
    vertical-align: middle;
}

.cart-table tbody tr:last-child td {
    border-bottom: none;
}

.cart-table tbody tr:hover {
    background-color: #f9f9f9;
}

/* Ticket Type */
.ticket-type {
    display: flex;
    align-items: center;
}

.ticket-type i {
    background-color: #e9f7ef;
    color: #2c7744;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 10px;
}

/* Price Cell */
.price-cell {
    font-weight: 600;
    color: #2c7744;
}

/* Remove Button */
.btn-remove {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #fff0f0;
    color: #dc3545;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-remove:hover {
    background-color: #dc3545;
    color: white;
}

/* Cart Summary */
.cart-summary {
    background-color: white;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    font-size: 1.2rem;
    font-weight: 600;
}

.total-price {
    color: #2c7744;
    font-size: 1.5rem;
}

/* Cart Actions */
.cart-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn i {
    margin-left: 8px;
    margin-right: 8px;
}

.btn-primary {
    background-color: #2c7744;
    color: white;
}

.btn-primary:hover {
    background-color: #1e5631;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(30, 86, 49, 0.2);
}

.btn-outline {
    background-color: transparent;
    border: 2px solid #2c7744;
    color: #2c7744;
}

.btn-outline:hover {
    background-color: #2c7744;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(30, 86, 49, 0.1);
}

/* Empty Cart */
.empty-cart {
    background-color: white;
    border-radius: 10px;
    padding: 3rem;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.empty-cart-icon {
    font-size: 4rem;
    color: #ccc;
    margin-bottom: 1.5rem;
}

.empty-cart h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.empty-cart p {
    color: #666;
    margin-bottom: 2rem;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .cart-actions {
        flex-direction: column;
        gap: 1rem;
    }

    .cart-actions .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .cart-table-container {
        overflow-x: auto;
    }

    .cart-table {
        min-width: 650px;
    }
}
</style>
@endsection