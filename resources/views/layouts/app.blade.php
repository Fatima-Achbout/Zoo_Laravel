<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Zoofari')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    /* Navbar Styles */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #ffffff;
        padding: 15px 40px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 100;
    }

    .nav-logo {
        display: flex;
        align-items: center;
    }

    .nav-logo img {
        height: 45px;
        margin-right: 12px;
        transition: transform 0.3s;
    }

    .nav-logo img:hover {
        transform: scale(1.05);
    }

    .brand-name {
        font-size: 24px;
        font-weight: 700;
        color: #2e7d32;
        letter-spacing: 0.5px;
    }

    .nav-links {
        display: flex;
        align-items: center;
    }

    .nav-links a {
        margin-left: 30px;
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: all 0.3s;
        position: relative;
    }

    .nav-links a:hover {
        color: #2e7d32;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background-color: #2e7d32;
        bottom: -5px;
        left: 0;
        transition: width 0.3s;
    }

    .nav-links a:hover::after {
        width: 100%;
    }

    .btn-auth {
        background-color: transparent;
        border: 2px solid #2e7d32;
        padding: 8px 20px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
        margin-left: 20px;
    }

    .btn-auth:hover {
        background-color: #2e7d32;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
    }

    .btn-auth.primary {
        background-color: #2e7d32;
        color: white;
    }

    .btn-auth.primary:hover {
        background-color: #1b5e20;
        border-color: #1b5e20;
    }

    /* Responsive Navbar */
    @media (max-width: 768px) {
        nav {
            padding: 15px 20px;
            flex-direction: column;
        }

        .nav-links {
            margin-top: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nav-links a {
            margin: 5px 10px;
            font-size: 0.9rem;
        }

        .btn-auth {
            margin: 5px 10px;
        }
    }
    </style>

    @yield('styles')
    <!-- for extra styles in child views -->
</head>

<body>
    <nav>
        <div class="nav-logo">
            <img src="{{ asset('images/icones/zoofari.png') }}" alt="Logo Zoofari" />
            <span class="brand-name">Zoofari</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Accueil</a>
            <a href="{{ route('tickets.offers') }}"><i class="fas fa-ticket-alt me-1"></i> Tickets</a>
            <a href="{{ route('cart.show') }}"><i class="fas fa-shopping-cart me-1"></i> Panier</a>
            <a href="{{ route('profile') }}"><i class="fas fa-user me-1"></i> Profil</a>
            <a href="{{ route('about') }}"><i class="fas fa-info-circle me-1"></i> À propos</a>
            <a href="{{ route('contact') }}"><i class="fas fa-envelope me-1"></i> Contact</a>

            @guest
            <a href="{{ route('login') }}" class="btn-auth primary">Se connecter</a>
            <a href="{{ route('register') }}" class="btn-auth">S'inscrire</a>
            @else
            <a href="{{ route('logout') }}" class="btn-auth" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-1"></i> Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
            @endguest
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
    <!-- for extra scripts in child views -->
</body>

</html>