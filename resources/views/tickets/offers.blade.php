@extends('layouts.app')

@section('content')
<div class="zoofari-tickets">
    <div class="container">
        <!-- Header -->
        <div class="tickets-header">
            <h1>Offres de Tickets</h1>
            <p class="lead">Réservez vos billets pour une expérience inoubliable</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert-message success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Tickets Container -->
        <div class="tickets-container">
            @foreach($tickets as $ticket)
            <div class="ticket-card">
                <div class="ticket-header">
                    <div class="ticket-type-icon">
                        <i class="fas {{ $ticket->type == 'Enfant' ? 'fa-child' : 'fa-user' }}"></i>
                    </div>
                    <div class="ticket-type-info">
                        <h3>{{ $ticket->type }}</h3>
                        <div class="ticket-price">{{ $ticket->price }} <span>DHS</span></div>
                    </div>
                </div>

                <div class="ticket-benefits">
                    @if($ticket->type == 'Enfant')
                    <div class="benefit"><i class="fas fa-check"></i> Accès à toutes les attractions</div>
                    <div class="benefit"><i class="fas fa-check"></i> Spectacles et animations</div>
                    <div class="benefit"><i class="fas fa-check"></i> Aire de jeux enfants</div>
                    @elseif($ticket->type == 'Adulte')
                    <div class="benefit"><i class="fas fa-check"></i> Accès standard</div>
                    <div class="benefit"><i class="fas fa-check"></i> Accès à toutes les attractions</div>
                    <div class="benefit"><i class="fas fa-check"></i> Nourrissage des animaux</div>
                    @else
                    <div class="benefit"><i class="fas fa-check"></i> Accès Prioritaire</div>
                    <div class="benefit"><i class="fas fa-check"></i> Accès à toutes les attractions</div>
                    <div class="benefit"><i class="fas fa-check"></i> Nourrissage des animaux</div>
                    <div class="benefit"><i class="fas fa-check"></i> Spectacles et animations</div>
                    <div class="benefit"><i class="fas fa-check"></i> Visites guidées disponibles</div>

                    @endif
                </div>

                <form method="POST" action="{{ route('cart.add') }}" class="ticket-form">
                    @csrf
                    <div class="form-group">
                        <label for="date-{{ $ticket->id }}">
                            <i class="fas fa-calendar-alt"></i> Date de visite
                        </label>
                        <input type="date" id="date-{{ $ticket->id }}" name="visit_date" required
                            min="{{ date('Y-m-d') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="quantity-{{ $ticket->id }}">
                            <i class="fas fa-ticket-alt"></i> Quantité
                        </label>
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn minus"
                                onclick="decrementQuantity('quantity-{{ $ticket->id }}')">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantity-{{ $ticket->id }}" name="quantity" min="1" value="1"
                                required class="form-control">
                            <button type="button" class="quantity-btn plus"
                                onclick="incrementQuantity('quantity-{{ $ticket->id }}')">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Cart Actions -->
        <div class="cart-actions">
            <a href="{{ route('cart.show') }}" class="btn btn-outline">
                <i class="fas fa-shopping-basket"></i> Voir le panier
            </a>

        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
/* Base Styles */
.zoofari-tickets {
    font-family: 'Poppins', sans-serif;
    color: #333;
    padding: 4rem 0 6rem;
    background-color: #f8f9fa;
    min-height: 80vh;
}

.zoofari-tickets .container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Tickets Header */
.tickets-header {
    text-align: center;
    margin-bottom: 3rem;
}

.tickets-header h1 {
    font-size: 2.5rem;
    color: #1e5631;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.tickets-header .lead {
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

/* Tickets Container */
.tickets-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-bottom: 3rem;
}

/* Ticket Card */
.ticket-card {
    background-color: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.ticket-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

/* Ticket Header */
.ticket-header {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background-color: #f8f9fa;
    border-bottom: 1px solid #f1f1f1;
}

.ticket-type-icon {
    width: 60px;
    height: 60px;
    background-color: #e9f7ef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.5rem;
}

.ticket-type-icon i {
    font-size: 1.8rem;
    color: #2c7744;
}

.ticket-type-info h3 {
    font-size: 1.4rem;
    color: #333;
    margin-bottom: 0.3rem;
}

.ticket-price {
    font-size: 1.6rem;
    font-weight: 700;
    color: #2c7744;
}

.ticket-price span {
    font-size: 1rem;
    font-weight: 400;
}

/* Ticket Benefits */
.ticket-benefits {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f1f1f1;
}

.benefit {
    display: flex;
    align-items: center;
    margin: 0.7rem 0;
    font-size: 0.95rem;
    color: #666;
}

.benefit i {
    color: #2c7744;
    margin-right: 0.5rem;
    font-size: 0.8rem;
}

/* Ticket Form */
.ticket-form {
    padding: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #333;
    font-size: 0.95rem;
}

.form-group label i {
    color: #2c7744;
    margin-right: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e1e1e1;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    outline: none;
}

.form-control:focus {
    border-color: #2c7744;
    box-shadow: 0 0 0 3px rgba(44, 119, 68, 0.1);
}

/* Quantity Selector */
.quantity-selector {
    display: flex;
    align-items: center;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border: 1px solid #e1e1e1;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-btn.minus {
    border-radius: 8px 0 0 8px;
}

.quantity-btn.plus {
    border-radius: 0 8px 8px 0;
}

.quantity-btn:hover {
    background-color: #e9f7ef;
    color: #2c7744;
}

.quantity-selector .form-control {
    width: 60px;
    text-align: center;
    border-radius: 0;
    height: 40px;
    padding: 0.375rem 0.75rem;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn i {
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

.btn-block {
    width: 100%;
    display: flex;
    justify-content: center;
}

/* Cart Actions */
.cart-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .cart-actions {
        flex-direction: column;
        align-items: center;
    }

    .cart-actions .btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .ticket-header {
        flex-direction: column;
        text-align: center;
    }

    .ticket-type-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
}
</style>

<script>
function incrementQuantity(id) {
    const input = document.getElementById(id);
    input.value = parseInt(input.value) + 1;
}

function decrementQuantity(id) {
    const input = document.getElementById(id);
    const value = parseInt(input.value);
    if (value > 1) {
        input.value = value - 1;
    }
}
</script>
@endsection