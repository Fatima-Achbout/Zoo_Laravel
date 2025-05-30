@extends('layouts.app')

@section('title', 'Inscription - Zoofari')

@section('content')
<style>
.register-section {
    display: flex;
    height: calc(100vh - 77px);
    position: relative;
    overflow: hidden;
    background-color: white;
}

.register-image {
    flex: 1;
    background-image: url('{{ asset("images/banniere.jpg") }}');
    /* use your banner image */
    background-size: cover;
    background-position: center;
    position: relative;
}

.register-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%);
    z-index: 1;
}

.image-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white;
    width: 80%;
    z-index: 2;
}

.image-overlay h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.image-overlay p {
    font-size: 1.2rem;
    font-weight: 300;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.register-form-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
}

.register-box {
    width: 100%;
    max-width: 450px;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    background-color: white;
    transition: transform 0.3s, box-shadow 0.3s;
}

.register-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.register-title {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-weight: 600;
    font-size: 2rem;
}

.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #757575;
    transition: color 0.3s;
}

.toggle-password:hover {
    color: #2e7d32;
}
</style>

<div class="register-section">
    <div class="register-image">
        <div class="image-overlay">
            <h1>Bienvenue à Zoofari</h1>
            <p>Découvrez la nature sauvage et vivez une expérience inoubliable parmi nos animaux extraordinaires.</p>
        </div>
    </div>
    <div class="register-form-container">
        <div class="register-box">
            <h2 class="register-title">Inscription</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="Nom complet" required autofocus />
                    <label for="name"><i class="fas fa-user me-2"></i>Nom complet</label>
                </div>

                <div class="form-floating mb-3">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Adresse email" required />
                    <label for="email"><i class="fas fa-envelope me-2"></i>Adresse email</label>
                </div>

                <div class="form-floating password-container mb-3">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Mot de passe"
                        required autocomplete="new-password" />
                    <label for="password"><i class="fas fa-lock me-2"></i>Mot de passe</label>
                    <span class="toggle-password" onclick="togglePassword('password')">
                        <i id="toggleIconPassword" class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="form-floating password-container mb-4">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirmer le mot de passe" required autocomplete="new-password" />
                    <label for="password_confirmation"><i class="fas fa-check-circle me-2"></i>Confirmer le mot de
                        passe</label>
                    <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                        <i id="toggleIconPasswordConfirm" class="fas fa-eye"></i>
                    </span>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                </button>
            </form>

            <div class="mt-4 text-center">
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = id === 'password' ? 'toggleIconPassword' : 'toggleIconPasswordConfirm';
    const toggleIcon = document.getElementById(icon);

    if (input.type === "password") {
        input.type = "text";
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection