<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - WheelyGoodCars</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <h1>WheelyGoodCars</h1>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('cars') }}">All Cars</a>
                <a href="{{ route('my-listings') }}">My Listings</a>
                <a href="{{ route('create-listing') }}">Add Listing</a>
            </nav>
        </header>

        <main>

        </main>
    </div>
</body>
</html>
