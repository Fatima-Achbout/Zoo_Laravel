@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

<div class="about-hero">
    <div class="about-text">
        <h1>À propos de notre Jardin Zoologique</h1>
        <p>Découvrez un monde d'aventure, de nature et de découverte</p>
    </div>
</div>

<div class="about-section">
    <div class="section-block">
        <div class="text-box">
            <h2>Zone Animalière</h2>
            <p>Découvrez une grande diversité d’animaux dans un environnement naturel.</p>
        </div>
        <img src="{{ asset('images/animaux.jpg') }}" alt="Zone Animalière">
    </div>

    <div class="section-block reverse">
        <img src="{{ asset('images/nourrir.jpg') }}" alt="Nourrir les animaux">
        <div class="text-box">
            <h2>Nourrir les animaux (VIP)</h2>
            <p>Participez à une activité exclusive avec les animaux pour les détenteurs du ticket VIP.</p>
        </div>
    </div>

    <div class="section-block">
        <div class="text-box">
            <h2>Musée interactif</h2>
            <p>Plongez dans l’histoire du règne animal avec des expositions éducatives et interactives.</p>
        </div>
        <img src="{{ asset('images/musee.jpg') }}" alt="Musée interactif">
    </div>

    <div class="section-block reverse">
        <img src="{{ asset('images/suprette.jpg') }}" alt="Supérette">
        <div class="text-box">
            <h2>Supérette</h2>
            <p>Achetez des boissons, snacks ou accessoires utiles dans notre supérette pratique.</p>
        </div>
    </div>

    <div class="section-block">
        <div class="text-box">
            <h2>Boutique de souvenirs</h2>
            <p>Ramenez un souvenir de votre visite : peluches, cartes postales, objets décoratifs...</p>
        </div>
        <img src="{{ asset('images/magasin.jpg') }}" alt="Boutique">
    </div>

    <div class="section-block reverse">
        <img src="{{ asset('images/restau.jpg') }}" alt="Restaurant">
        <div class="text-box">
            <h2>Restaurant</h2>
            <p>Profitez d’un moment de détente dans notre restaurant ambiance jungle.</p>
        </div>
    </div>

    <div class="section-block">
        <div class="text-box">
            <h2>Promenade en pleine nature</h2>
            <p>Explorez les sentiers au milieu de la verdure et de la faune.</p>
        </div>
        <img src="{{ asset('images/nature.jpg') }}" alt="Nature">
    </div>

    <div class="section-block reverse">
        <img src="{{ asset('images/guide.jpg') }}" alt="VIP">
        <div class="text-box">
            <h2>Accompagnement VIP</h2>
            <p>Bénéficiez d’une visite guidée personnalisée avec un expert du parc.</p>
        </div>
    </div>

    <div class="section-block">
        <div class="text-box">
            <h2>Parking gratuit</h2>
            <p>Un grand parking sécurisé à votre disposition à l’entrée du parc.</p>
        </div>
        <img src="{{ asset('images/parking.jpg') }}" alt="Parking">
    </div>
</div>
@endsection
