@extends('layouts.app')

@section('title', $car->make . ' ' . $car->model . ' - WheelyGoodCars')

@section('content')
<div class="content-card">
    <div class="car-detail-hero page-header">
        <div>
            <h1 class="page-title">{{ $car->make }} {{ $car->model }}</h1>
            <p class="page-subtitle">Kenteken {{ $car->license_plate }}</p>
        </div>

        <div class="car-detail-summary">
            <div class="car-detail-stat">
                <span class="car-detail-stat-label">Vraagprijs</span>
                <span class="car-detail-stat-value">EUR {{ number_format($car->price, 2) }}</span>
            </div>
            <div class="car-detail-stat">
                <span class="car-detail-stat-label">Bekeken</span>
                <span class="car-detail-stat-value">{{ $car->views }}</span>
            </div>
            <div class="car-detail-stat">
                <span class="car-detail-stat-label">Aanbieder</span>
                <span class="car-detail-stat-value">{{ $car->user->name ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="listings-table">
            <tbody>
                <tr><th>Prijs</th><td>EUR {{ number_format($car->price, 2) }}</td></tr>
                <tr><th>Bouwjaar</th><td>{{ $car->production_year ?? '-' }}</td></tr>
                <tr><th>Kilometerstand</th><td>{{ number_format($car->mileage) }} km</td></tr>
                <tr><th>Kleur</th><td>{{ $car->color ?? '-' }}</td></tr>
                <tr><th>Zitplaatsen</th><td>{{ $car->seats ?? '-' }}</td></tr>
                <tr><th>Deuren</th><td>{{ $car->doors ?? '-' }}</td></tr>
                <tr><th>Gewicht</th><td>{{ $car->weight ? number_format($car->weight) . ' kg' : '-' }}</td></tr>
                <tr><th>Views</th><td>{{ $car->views }}</td></tr>
                <tr><th>Aanbieder</th><td>{{ $car->user->name ?? '-' }}</td></tr>
            </tbody>
        </table>
    </div>

    @if ($car->tags->isNotEmpty())
        <div class="car-tags detail-tags">
            @php
                $tagTones = ['tone-1', 'tone-2', 'tone-3', 'tone-4', 'tone-5', 'tone-6'];
            @endphp
            @foreach ($car->tags as $tag)
                <span class="car-tag {{ $tagTones[$loop->index % count($tagTones)] }}">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif
</div>
@endsection
