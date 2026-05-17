@extends('layouts.app')

@section('title', 'Inloggen - WheelyGoodCars')

@section('content')
<div class="content-card auth-box">
    <h1 class="page-title text-center">Inloggen</h1>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
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
            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" class="checkbox-label">Onthoud mij</label>
            </div>
        </div>

        <button type="submit" class="btn-primary">Inloggen</button>
    </form>

    <div class="text-center mt-4">
        <p>Nog geen account? <a href="{{ route('register') }}" class="link">Registreer hier</a></p>
    </div>
</div>
@endsection
