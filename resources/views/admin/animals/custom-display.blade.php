@extends('layouts.appAdmin')

@section('content')
<div class="animal-display">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="animal-card">
                    
                    <div class="animal-description">
                        <h2>{{ $animal->name }}</h2>
                        <div class="animal-details">
                            <div class="detail-item">
                                <span class="detail-label">Espèce:</span>
                                <span class="detail-value">{{ $animal->species }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Habitat:</span>
                                <span class="detail-value">{{ $animal->habitat }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Origine:</span>
                                <span class="detail-value">{{ $animal->origin }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .animal-display {
        padding: 40px 0;
        background-color: #f8f9fa;
    }
    
    .animal-card {
        display: flex;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .animal-image {
        width: 50%;
    }
    
    .animal-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .animal-description {
        width: 50%;
        padding: 30px;
    }
    
    .animal-description h2 {
        color: #006455;
        margin-bottom: 20px;
        font-size: 28px;
    }
    
    .description-text {
        margin-bottom: 30px;
        line-height: 1.6;
        color: #333;
    }
    
    .animal-details {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 6px;
    }
    
    .detail-item {
        display: flex;
        margin-bottom: 10px;
    }
    
    .detail-label {
        font-weight: bold;
        min-width: 100px;
    }
    
    .detail-value {
        color: #444;
    }
    
    @media (max-width: 768px) {
        .animal-card {
            flex-direction: column;
        }
        
        .animal-image, 
        .animal-description {
            width: 100%;
        }
    }
</style>
@endsection