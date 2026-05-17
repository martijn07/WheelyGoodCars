@extends('layouts.app')

@section('title', 'Home - WheelyGoodCars')

@section('content')
<div class="home-shell">
    <div class="content-card home-hero">
        <div class="page-header home-hero-header">
            <p class="home-kicker">WheelyGoodCars</p>
            <h1 class="page-title">Welkom bij WheelyGoodCars</h1>
            <p class="page-subtitle">De beste plek om je auto te kopen of verkopen</p>
        </div>

        <div class="home-hero-actions">
            <a href="{{ route('cars') }}" class="home-hero-button primary">Bekijk aanbod</a>

            @guest
                <a href="{{ route('login') }}" class="home-hero-button secondary">Inloggen</a>
            @else
                <a href="{{ route('my-listings') }}" class="home-hero-button secondary">Mijn aanbiedingen</a>
            @endguest
        </div>
    </div>

    <div class="home-grid">
        <div class="home-card">
            <h4 class="home-card-title">Bekijk Auto's</h4>
            <p class="home-card-text">Ontdek ons uitgebreide aanbod</p>
            <a href="{{ route('cars') }}" class="home-card-link">Bekijk Aanbod</a>
        </div>

        @auth
            <div class="home-card home-card-accent">
                <h4 class="home-card-title">Mijn Aanbiedingen</h4>
                <p class="home-card-text">Beheer je auto advertenties</p>
                <a href="{{ route('my-listings') }}" class="home-card-link">Naar Mijn Listings</a>
            </div>

            <div class="home-card">
                <h4 class="home-card-title">Verkoop Je Auto</h4>
                <p class="home-card-text">Plaats een nieuwe advertentie</p>
                <a href="{{ route('create-listing') }}" class="home-card-link">Aanbieding Toevoegen</a>
            </div>
        @endauth
    </div>
</div>
@endsection
