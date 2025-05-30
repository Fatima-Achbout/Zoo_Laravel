@extends('layouts.app')

@section('content')
<!-- Custom CSS -->
<style>
:root {
    --primary-color: #4CAF50;
    --primary-dark: #388E3C;
    --secondary-color: #f8f9fa;
    --accent-color: #8BC34A;
    --text-dark: #2C3E50;
    --text-light: #6c757d;
    --border-radius: 12px;
    --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

body {
    background-color: #f5f7fa;
    font-family: 'Poppins', sans-serif;
}

.container {
    max-width: 650px;
    margin: 3rem auto;
    padding: 0 1rem;
}

h2 {
    color: var(--primary-color);
    font-size: 2.8rem;
    margin-bottom: 2.5rem;
    text-align: center;
    font-weight: 700;
    position: relative;
}

h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 5px;
    background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    border-radius: 10px;
}

.form-wrapper {
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2.5rem;
    margin-bottom: 2rem;
    border: none;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.form-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
}

.form-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 10px;
    height: 100%;
    background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
}

.alert-success {
    background: linear-gradient(to right, rgba(76, 175, 80, 0.1), rgba(139, 195, 74, 0.1));
    color: #2E7D32;
    border-left: 4px solid var(--primary-color);
    border-radius: var(--border-radius);
    padding: 1.2rem;
    margin-bottom: 1.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.alert-success i {
    font-size: 1.2rem;
    margin-right: 10px;
}

.alert-danger {
    background-color: rgba(244, 67, 54, 0.1);
    color: #E53935;
    border-left: 4px solid #E53935;
    border-radius: var(--border-radius);
    padding: 1.2rem;
    margin-bottom: 1.8rem;
}

.alert-danger ul {
    margin-bottom: 0;
    padding-left: 1.5rem;
}

.alert-danger li {
    margin-bottom: 0.5rem;
}

.alert-danger li:last-child {
    margin-bottom: 0;
}

.mb-4 {
    margin-bottom: 2rem !important;
}

.form-group {
    margin-bottom: 1.8rem;
    position: relative;
}

.form-label {
    display: block;
    margin-bottom: 0.8rem;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 1.05rem;
    transition: color 0.3s ease;
}

.form-control {
    width: 90%;
    padding: 0.85rem 1.2rem 0.85rem 3rem;
    border: 2px solid #e8eef3;
    border-radius: 10px;
    font-size: 1rem;
    color: var(--text-dark);
    background-color: #fafbfd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.15);
    background-color: #fff;
}

.input-icon {
    position: absolute;
    left: 15px;
    top: 42px;
    transform: translateY(-50%);
    color: var(--primary-color);
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.form-group:focus-within .input-icon {
    color: var(--primary-dark);
    transform: translateY(-50%) scale(1.1);
}

.form-group:focus-within .form-label {
    color: var(--primary-color);
}

.btn-success {
    background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    color: white;
    border: none;
    border-radius: 50px;
    padding: 0.9rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    width: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
}

.btn-success:hover {
    background: linear-gradient(to right, var(--primary-dark), var(--primary-color));
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
}

.btn-success:active {
    transform: translateY(0);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

.btn-success i {
    margin-right: 8px;
    font-size: 1.1rem;
}

/* Animation d'onde pour le bouton */
.btn-success::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.3);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

.btn-success:focus:not(:active)::after {
    animation: ripple 1s ease-out;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }

    20% {
        transform: scale(25, 25);
        opacity: 0.3;
    }

    100% {
        transform: scale(50, 50);
        opacity: 0;
    }
}

/* Ajout d'un statut de force du mot de passe */
.password-strength {
    margin-top: 8px;
    height: 5px;
    border-radius: 5px;
    background-color: #e9ecef;
    transition: all 0.3s ease;
}

.password-strength-meter {
    height: 90%;
    border-radius: 5px;
    transition: all 0.3s ease;
    width: 0;
}

.password-strength-text {
    font-size: 0.8rem;
    margin-top: 5px;
    color: var(--text-light);
    display: none;
}

/* Animations pour les inputs */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group {
    animation: fadeIn 0.5s ease forwards;
    opacity: 0;
}

.form-group:nth-child(1) {
    animation-delay: 0.1s;
}

.form-group:nth-child(2) {
    animation-delay: 0.2s;
}

.form-group:nth-child(3) {
    animation-delay: 0.3s;
}

.form-group:nth-child(4) {
    animation-delay: 0.4s;
}
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container">
    <h2>Modifier mon profil</h2>

    <div class="form-wrapper">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>{{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nom complet</label>
                <i class="fas fa-user input-icon"></i>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Adresse email</label>
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="password" name="password">
                <div class="password-strength">
                    <div class="password-strength-meter"></div>
                </div>
                <div class="password-strength-text"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <i class="fas fa-check-circle input-icon"></i>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>Enregistrer
            </button>
        </form>
    </div>
</div>

<!-- JavaScript pour l'indicateur de force du mot de passe -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const meter = document.querySelector('.password-strength-meter');
    const text = document.querySelector('.password-strength-text');

    passwordInput.addEventListener('input', function() {
        const value = passwordInput.value;
        const strength = calculatePasswordStrength(value);

        // Afficher l'indicateur seulement si un mot de passe est saisi
        if (value.length > 0) {
            text.style.display = 'block';

            // Mettre à jour la barre de progression
            meter.style.width = strength.percent + '%';

            // Changer la couleur selon la force
            if (strength.percent <= 25) {
                meter.style.backgroundColor = '#dc3545'; // Rouge
                text.innerText = 'Très faible';
                text.style.color = '#dc3545';
            } else if (strength.percent <= 50) {
                meter.style.backgroundColor = '#ffc107'; // Jaune
                text.innerText = 'Faible';
                text.style.color = '#ffc107';
            } else if (strength.percent <= 75) {
                meter.style.backgroundColor = '#fd7e14'; // Orange
                text.innerText = 'Moyen';
                text.style.color = '#fd7e14';
            } else {
                meter.style.backgroundColor = '#28a745'; // Vert
                text.innerText = 'Fort';
                text.style.color = '#28a745';
            }
        } else {
            text.style.display = 'none';
            meter.style.width = '0%';
        }
    });

    function calculatePasswordStrength(password) {
        let strength = 0;

        // Longueur
        if (password.length > 6) strength += 25;
        if (password.length > 10) strength += 25;

        // Complexité
        if (/[A-Z]/.test(password)) strength += 12.5;
        if (/[a-z]/.test(password)) strength += 12.5;
        if (/[0-9]/.test(password)) strength += 12.5;
        if (/[^A-Za-z0-9]/.test(password)) strength += 12.5;

        return {
            percent: Math.min(100, strength)
        };
    }

    // Vérification de la correspondance des mots de passe
    const confirmInput = document.getElementById('password_confirmation');

    confirmInput.addEventListener('input', function() {
        if (passwordInput.value !== confirmInput.value) {
            confirmInput.style.borderColor = '#dc3545';
            confirmInput.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.15)';
        } else {
            confirmInput.style.borderColor = '#28a745';
            confirmInput.style.boxShadow = '0 0 0 4px rgba(40, 167, 69, 0.15)';
        }
    });
});
</script>
@endsection