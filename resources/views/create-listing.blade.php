@extends('layouts.app')

@section('title', 'Aanbieding Toevoegen - WheelyGoodCars')

@section('content')
<div class="content-card">
    @if ($step !== 1)
        <div class="page-header">
            <h1 class="page-title">Nieuwe Aanbieding Toevoegen</h1>
            <p class="page-subtitle">Vul het kenteken in en voeg je auto toe</p>
        </div>
    @endif

    <div class="step-progress {{ $step === 1 ? 'step-progress-step-1' : 'step-progress-step-2' }}" aria-label="Voortgang van de aanbieding">
        <div class="step-progress-header">
            <span>Stap {{ $step }} van 2</span>
        </div>
        <div class="step-progress-track" aria-hidden="true">
            <div class="step-progress-fill"></div>
        </div>
    </div>

    @if ($step === 1)
        <form action="{{ route('verify-license-plate') }}" method="POST" class="license-plate-stage">
            @csrf

            <div class="form-group">
                <label for="license_plate" class="sr-only">Kenteken</label>
                <div class="license-plate-field">
                    <span class="license-country-strip" aria-hidden="true">NL</span>
                    <input
                        type="text"
                        id="license_plate"
                        name="license_plate"
                        placeholder="AB-123-CD"
                        value="{{ old('license_plate') }}"
                        required
                        class="license-plate-input uppercase-input"
                    >
                </div>
            </div>

            <button type="submit" class="btn-primary plate-next-btn">Volgende -></button>
        </form>
    @else
        <h2 class="step-title">Vul de gegevens in</h2>
        <form action="{{ route('listings.store') }}" method="POST">
            @csrf

            <input type="hidden" name="license_plate" value="{{ $licensePlate }}">

            <div class="kenteken-info">
                <strong>Kenteken:</strong> {{ $licensePlate }}
            </div>

            <div class="form-group">
                <label for="make">Merk *</label>
                <input
                    type="text"
                    id="make"
                    name="make"
                    value="{{ old('make', $carData['make'] ?? '') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="model">Model *</label>
                <input
                    type="text"
                    id="model"
                    name="model"
                    value="{{ old('model', $carData['model'] ?? '') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="price">Prijs (EUR) *</label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    step="0.01"
                    min="0"
                    value="{{ old('price') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="mileage">Kilometerstand *</label>
                <input
                    type="number"
                    id="mileage"
                    name="mileage"
                    min="0"
                    value="{{ old('mileage') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="production_year">Bouwjaar</label>
                <input
                    type="number"
                    id="production_year"
                    name="production_year"
                    min="1900"
                    max="{{ date('Y') + 1 }}"
                    value="{{ old('production_year', $carData['production_year'] ?? '') }}"
                >
            </div>

            <div class="form-group">
                <label for="color">Kleur</label>
                <input
                    type="text"
                    id="color"
                    name="color"
                    value="{{ old('color', $carData['color'] ?? '') }}"
                >
            </div>

            <div class="form-group">
                <label for="seats">Aantal zitplaatsen</label>
                <input
                    type="number"
                    id="seats"
                    name="seats"
                    min="1"
                    value="{{ old('seats', $carData['seats'] ?? '') }}"
                >
            </div>

            <div class="form-group">
                <label for="doors">Aantal deuren</label>
                <input
                    type="number"
                    id="doors"
                    name="doors"
                    min="1"
                    value="{{ old('doors', $carData['doors'] ?? '') }}"
                >
            </div>

            <div class="form-group">
                <label for="weight">Gewicht (kg)</label>
                <input
                    type="number"
                    id="weight"
                    name="weight"
                    min="0"
                    value="{{ old('weight', $carData['weight'] ?? '') }}"
                >
            </div>

            <div class="form-group tag-group">
                <label>Tags</label>
                <div class="tag-grid">
                    @php
                        $tagTones = ['tone-1', 'tone-2', 'tone-3', 'tone-4', 'tone-5', 'tone-6'];
                    @endphp
                    @forelse (($availableTags ?? collect()) as $tag)
                        <label class="tag-option {{ $tagTones[$loop->index % count($tagTones)] }}">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', [])))>
                            <span class="tag-pill">{{ $tag->name }}</span>
                        </label>
                    @empty
                        <p class="empty-tags-state">Er zijn nog geen tags beschikbaar.</p>
                    @endforelse
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('create-listing', ['reset' => 1]) }}" class="btn-secondary">
                    <- Terug
                </a>
                <button type="submit" class="btn-primary btn-grow">
                    Aanbieding toevoegen
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
