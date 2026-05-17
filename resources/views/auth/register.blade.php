@extends('layouts.app')

@section('title', 'Registreren - WheelyGoodCars')

@section('content')
<div class="content-card auth-box">
    <h1 class="page-title text-center">Registreren</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Naam</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <div class="form-group">
            <label for="password_confirmation">Bevestig Wachtwoord</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
            >
        </div>

        <button type="submit" class="btn-primary">Registreren</button>
    </form>

    <div class="text-center mt-4">
        <p>Al een account? <a href="{{ route('login') }}" class="link">Login hier</a></p>
    </div>
</div>
@endsection
