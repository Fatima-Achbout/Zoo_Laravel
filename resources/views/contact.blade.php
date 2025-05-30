@extends('layouts.app')

@section('content')

<style>
    .contact-section {
        background-image: url('/images/zoo-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 60px 20px;
        color: white;
        text-align: center;
        position: relative;
    }

    .contact-section::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(3px);
        z-index: 0;
    }

    .contact-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: auto;
        background-color: rgba(255, 255, 255, 0.05);
        padding: 40px;
        border-radius: 10px;
    }

    .contact-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 40px;
        margin-top: 30px;
    }

    .contact-box {
        flex: 1 1 300px;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 8px;
    }

    .contact-box h3 {
        margin-bottom: 10px;
        color: #f5f5f5;
    }

    .contact-box p, .contact-box a {
        color: #ddd;
        font-size: 16px;
        text-decoration: none;
    }
</style>
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<div class="contact-section">
    <div class="contact-content">
        <h1>Contactez-nous</h1>
        <div class="contact-grid">

            <div class="contact-box">
                <h3>Email</h3>
                <p>contact@zoofari.ma</p>
            </div>

            <div class="contact-box">
                <h3>Téléphone</h3>
                <p>+212 6 12 34 56 78</p>
            </div>

            <div class="contact-box">
                <h3>Adresse</h3>
                <p>123 Rue Safari, Marrakech, Maroc</p>
            </div>

            <div class="contact-box">
                <h3>Instagram</h3>
                <p><a href="https://instagram.com/zoofari" target="_blank">@zoofari</a></p>
            </div>

        </div>
    </div>
</div>

@endsection