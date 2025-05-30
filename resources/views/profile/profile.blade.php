@extends('layouts.app')

@section('content')
<!-- Custom CSS -->
<style>
:root {
    --primary-color: #34A853;
    --primary-dark: #2E8B57;
    --secondary-color: #f8f9fa;
    --accent-color: #FFD700;
    --text-dark: #333;
    --text-light: #6c757d;
    --border-radius: 10px;
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.account-container {
    max-width: 850px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.page-title {
    color: var(--primary-color);
    font-size: 2.5rem;
    margin-bottom: 2rem;
    text-align: center;
    font-weight: 700;
    position: relative;
}

.page-title:after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

.welcome-card {
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
    margin-bottom: 2rem;
    border: none;
    position: relative;
    overflow: hidden;
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 8px;
    height: 100%;
    background-color: var(--primary-color);
}

.welcome-title {
    font-size: 1.75rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.profile-info {
    padding: 0.5rem 0;
}

.profile-item {
    display: flex;
    margin-bottom: 0.75rem;
    align-items: center;
}

.profile-label {
    font-weight: 600;
    width: 120px;
    color: var(--text-dark);
}

.profile-value {
    color: var(--text-light);
}

.btn-edit {
    background-color: white;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-edit:hover {
    background-color: var(--primary-color);
    color: white;
}

.purchase-card {
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
    margin-bottom: 2rem;
    border: none;
}

.purchase-title {
    font-size: 1.4rem;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.purchase-title i {
    margin-right: 10px;
    color: var(--primary-color);
}

.purchase-details {
    list-style: none;
    padding: 0;
}

.purchase-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
}

.purchase-item:last-child {
    border-bottom: none;
}

.purchase-label {
    font-weight: 600;
    width: 120px;
    color: var(--text-dark);
}

.purchase-value {
    color: var(--text-light);
}

.purchase-highlight {
    color: var(--primary-color);
    font-weight: 600;
}

.tickets-title {
    font-size: 1.75rem;
    color: var(--text-dark);
    margin: 2rem 0 1.5rem;
}

.ticket-card {
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 1.25rem;
    margin-bottom: 1rem;
    border: none;
    transition: transform 0.2s;
}

.ticket-card:hover {
    transform: translateY(-3px);
}

.ticket-info {
    flex-grow: 1;
}

.ticket-id {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

.ticket-date {
    font-size: 0.85rem;
    color: var(--text-light);
}

.btn-download {
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 0.5rem 1.25rem;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-download:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

.empty-tickets {
    text-align: center;
    color: var(--text-light);
    background-color: var(--secondary-color);
    padding: 2rem;
    border-radius: var(--border-radius);
}

.empty-tickets i {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="account-container">
    <h1 class="page-title">Mon compte</h1>

    <!-- Personal info card -->
    <div class="welcome-card">
        <h3 class="welcome-title">Bienvenue, {{ $user->name }} !</h3>
        <div class="profile-info">
            <div class="profile-item">
                <div class="profile-label"><i class="fas fa-user me-2"></i>Nom :</div>
                <div class="profile-value">{{ $user->name }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label"><i class="fas fa-envelope me-2"></i>Email :</div>
                <div class="profile-value">{{ $user->email }}</div>
            </div>
            <div class="profile-item">
                <div class="profile-label"><i class="fas fa-lock me-2"></i>Mot de passe :</div>
                <div class="profile-value"></div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-edit">
                <i class="fas fa-pen me-2"></i>Modifier les informations
            </a>
        </div>
    </div>

    <!-- Last purchase card -->
    @if(!empty($lastPurchase))
    <div class="purchase-card">
        <h4 class="purchase-title">
            <i class="fas fa-ticket-alt"></i>
            Dernier achat
        </h4>
        <ul class="purchase-details">
            <li class="purchase-item">
                <div class="purchase-label">Type de ticket :</div>
                <div class="purchase-value">
                    @php
                    $types = $lastPurchase->tickets->map(function($orderTicket) {
                    return $orderTicket->ticket->type ?? 'N/A';
                    })->unique()->implode(', ');
                    @endphp
                    {{ $types }}
                </div>
            </li>

            <li class="purchase-item">
                <div class="purchase-label">Date :</div>
                <div class="purchase-value">{{ $lastPurchase->created_at->format('d/m/Y') }}</div>
            </li>

            <li class="purchase-item">
                <div class="purchase-label">Quantité :</div>
                <div class="purchase-value">{{ $lastPurchase->tickets->sum('quantity') }}</div>
            </li>

            <li class="purchase-item">
                <div class="purchase-label">Total :</div>
                <div class="purchase-value purchase-highlight">{{ $lastPurchase->amount }} DHS</div>
            </li>
        </ul>
    </div>
    @endif

    <!-- All Orders list -->
    <h3 class="tickets-title"><i class="fas fa-list me-2"></i>Mes tickets</h3>

    @if($orders->isEmpty())
    <div class="empty-tickets">
        <i class="fas fa-ticket-alt"></i>
        <p>Aucun ticket acheté pour le moment.</p>
        <a href="{{ route('tickets.offers') }}" class="btn btn-download mt-3">
            <i class="fas fa-shopping-cart me-2"></i>Acheter des tickets
        </a>
    </div>
    @else
    @foreach($orders as $order)
    <div class="ticket-card d-flex justify-content-between align-items-center">
        <div class="ticket-info">
            <p class="ticket-id">Commande #{{ $order->id }}</p>
            <p class="ticket-date">{{ $order->created_at->format('d/m/Y') }} - {{ $order->amount }} DHS</p>
        </div>
        <a href="{{ route('ticket.download', $order->id) }}" class="btn btn-download">
            <i class="fas fa-download me-1"></i> Télécharger
        </a>
    </div>
    @endforeach
    @endif

</div>
@endsection