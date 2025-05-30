@extends('layouts.app')

@section('content')
<div class="zoofari-home">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content container">
            <div class="hero-text">
                <h1 class="hero-title">Partez à la rencontre des merveilles de la nature.</h1>
                <p class="hero-subtitle">Une fenêtre ouverte sur le monde animal!</p>
                <a href="{{ route('tickets.offers') }}" class="btn btn-primary btn-lg">Réserver une visite</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/1.jpg') }}" alt="Lémurien" class="img-fluid rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <div class="container">
            <div class="section-header text-center">
                <h2>Découvrez notre diversité animale</h2>
                <p class="lead">Explorez les habitats de nos espèces exceptionnelles</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="{{ asset('images/2.jpg') }}" alt="Animal 1" class="img-fluid">
                    <div class="gallery-overlay">
                        <span>Savane africaine</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/3.jpg') }}" alt="Animal 2" class="img-fluid">
                    <div class="gallery-overlay">
                        <span>Forêt tropicale</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/4.jpg') }}" alt="Animal 3" class="img-fluid">
                    <div class="gallery-overlay">
                        <span>Monde marin</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/5.jpg') }}" alt="Animal 4" class="img-fluid">
                    <div class="gallery-overlay">
                        <span>Pôle arctique</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/6.jpg') }}" alt="Animal 5" class="img-fluid">
                    <div class="gallery-overlay">
                        <span>Désert</span>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/7.jpg') }}" alt="Animal 6" class="img-fluid">
                    <div class="gallery-overlay">
                        <span>Zone montagneuse</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-container">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <h3 class="stat-number">12305</h3>
                    <p class="stat-text">Total d'animaux</p>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-number">1200</h3>
                    <p class="stat-text">Visiteurs par jour</p>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="stat-number">3000</h3>
                    <p class="stat-text">Abonnements</p>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="stat-number">12305</h3>
                    <p class="stat-text">Animaux sauvés</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info">
        <div class="container">
            <div class="info-wrapper">
                <div class="info-column">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Horaires de visite</h4>
                        <ul class="info-list">
                            <li>7/7 jrs : 09:00 - 18:00</li>
                        </ul>
                    </div>
                </div>
                <div class="info-column">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h4>Informations de contact</h4>
                        <ul class="info-list">
                            <li><i class="fas fa-envelope-open"></i> contact@zoofari.ma</li>
                            <li><i class="fas fa-phone"></i> +212 6 12 34 56 78</li>
                            <li><i class="fas fa-map-marker-alt"></i> 123 Rue Safari, Marrakech</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
/* Base Styles */
.zoofari-home {
    font-family: 'Poppins', sans-serif;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-header {
    margin-bottom: 3rem;
}

.section-header h2 {
    font-size: 2.5rem;
    color: #2c7744;
    margin-bottom: 1rem;
}

.lead {
    font-size: 1.2rem;
    color: #666;
}

/* Hero Section */
.hero {
    background: linear-gradient(to right, #f8f9fa 50%, #e9f7ef 100%);
    padding: 6rem 0;
    overflow: hidden;
}

.hero-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.hero-text {
    flex: 1;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    color: #1e5631;
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: #555;
}

.hero-image {
    flex: 1;
    position: relative;
}

.hero-image img {
    border-radius: 12px;
    max-width: 100%;
    height: auto;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.hero-image img:hover {
    transform: scale(1.02);
}

.btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #2c7744;
    color: white;
    border: 2px solid #2c7744;
}

.btn-primary:hover {
    background-color: #1e5631;
    border-color: #1e5631;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(30, 86, 49, 0.2);
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

/* Gallery Section */
.gallery {
    padding: 6rem 0;
    background-color: #fff;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
    padding: 1.5rem;
    color: white;
    font-weight: 600;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
    transform: translateY(0);
}

/* Stats Section */
.stats {
    background-color: #f8f9fa;
    padding: 5rem 0;
}

.stats-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 2rem;
}

.stat-box {
    flex: 1;
    min-width: 200px;
    background-color: white;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.stat-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.stat-icon {
    margin-bottom: 1rem;
}

.stat-icon i {
    font-size: 2.5rem;
    color: #2c7744;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e5631;
    margin-bottom: 0.5rem;
}

.stat-text {
    color: #666;
    font-size: 1.1rem;
}

/* Info Section */
.info {
    padding: 5rem 0;
    background-color: #fff;
}

.info-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
}

.info-column {
    flex: 1;
    min-width: 300px;
}

.info-card {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 2rem;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.info-card:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.info-icon {
    margin-bottom: 1.5rem;
}

.info-icon i {
    font-size: 2rem;
    color: #2c7744;
}

.info-card h4 {
    font-size: 1.5rem;
    color: #1e5631;
    margin-bottom: 1.5rem;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
}

.info-list li i {
    margin-right: 10px;
    color: #2c7744;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .hero-content {
        flex-direction: column;
    }
    
    .hero-text {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .stat-box {
        min-width: calc(50% - 2rem);
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    .stat-box {
        min-width: 100%;
    }
    
    .info-column {
        min-width: 100%;
    }
}
</style>
@endsection