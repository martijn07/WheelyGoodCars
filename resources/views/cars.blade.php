@extends('layouts.app')

@section('title', 'Alle Auto\'s - WheelyGoodCars')

@section('content')
<div class="content-card">
    <div class="page-header">
        <h1 class="page-title">Alle Auto's</h1>
        <p class="page-subtitle">Ontdek ons uitgebreide aanbod van tweedehands auto's</p>
    </div>

    @if ($cars->isEmpty())
        <div class="cars-grid">
            <div class="cars-empty-card">
                <p class="cars-empty-title">Geen auto's beschikbaar</p>
                <p class="cars-empty-subtitle">Kom later terug voor nieuwe aanbiedingen</p>
            </div>
        </div>
    @else
        <div class="cars-grid">
            @php
                $tagTones = ['tone-1', 'tone-2', 'tone-3', 'tone-4', 'tone-5', 'tone-6'];
            @endphp
            @foreach ($cars as $car)
                <article class="car-card {{ in_array($car->id, $highlightedCarIds ?? []) ? 'car-card-featured' : '' }}">
                    <a href="{{ route('cars.show', $car) }}" class="car-card-link">
                        <div class="car-card-header">
                            <h2 class="car-title">{{ $car->make }} {{ $car->model }}</h2>
                            <span class="car-price">EUR {{ number_format($car->price, 2) }}</span>
                        </div>

                        <div class="car-plate">{{ $car->license_plate }}</div>

                        <ul class="car-meta-list">
                            <li>Bouwjaar: {{ $car->production_year ?? '-' }}</li>
                            <li>Kilometerstand: {{ number_format($car->mileage) }} km</li>
                            <li>Kleur: {{ $car->color ?? '-' }}</li>
                            <li>Bekeken: {{ $car->views }}</li>
                        </ul>

                        @if ($car->tags->isNotEmpty())
                            <div class="car-tags">
                                @foreach ($car->tags as $tag)
                                    <span class="car-tag {{ $tagTones[$loop->index % count($tagTones)] }}">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <span class="car-detail-link">Bekijk details</span>
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
