@extends('layouts.app')

@section('title', 'Mijn Aanbiedingen - WheelyGoodCars')

@section('content')
<div class="content-card">
    <div class="header-actions">
        <div class="page-header tight">
            <h1 class="page-title">Jouw Auto Aanbiedingen</h1>
            <p class="page-subtitle">Beheer je auto advertenties</p>
        </div>
        <a href="{{ route('create-listing') }}" class="btn-add">+ Nieuwe Aanbieding</a>
    </div>

    @if ($cars->isEmpty())
        <div class="table-container">
            <div class="empty-state">
                <h3>Nog geen aanbiedingen</h3>
                <p>Je hebt nog geen auto's aangeboden. Klik op "Nieuwe Aanbieding" om te beginnen.</p>
            </div>
        </div>
    @else
        <div class="table-container">
            <table class="listings-table">
                <thead>
                    <tr>
                        <th>Kenteken</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Tags</th>
                        <th>Bouwjaar</th>
                        <th>Kilometerstand</th>
                        <th>Prijs</th>
                        <th>Kleur</th>
                        <th>Bekeken</th>
                        <th>Bijgewerkt</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tagTones = ['tone-1', 'tone-2', 'tone-3', 'tone-4', 'tone-5', 'tone-6'];
                    @endphp
                    @foreach ($cars as $car)
                        <tr>
                            <td><strong>{{ $car->license_plate }}</strong></td>
                            <td>{{ $car->make }}</td>
                            <td>{{ $car->model }}</td>
                            <td>
                                @if ($car->tags->isNotEmpty())
                                    <div class="table-tags">
                                        @foreach ($car->tags as $tag)
                                            <span class="table-tag {{ $tagTones[$loop->index % count($tagTones)] }}">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="muted-text">Geen tags</span>
                                @endif
                            </td>
                            <td>{{ $car->production_year ?? '-' }}</td>
                            <td>{{ number_format($car->mileage) }} km</td>
                            <td class="price">EUR {{ number_format($car->price, 2) }}</td>
                            <td>{{ $car->color ?? '-' }}</td>
                            <td>{{ $car->views }}</td>
                            <td>{{ $car->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <form
                                    action="{{ route('listings.destroy', $car) }}"
                                    method="POST"
                                    class="inline-form"
                                    onsubmit="return confirm('Weet je zeker dat je deze aanbieding wilt verwijderen?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="listings-total">
            Totaal: {{ $cars->count() }} {{ $cars->count() === 1 ? 'aanbieding' : 'aanbiedingen' }}
        </div>
    @endif
</div>
@endsection
