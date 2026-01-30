<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Listing - WheelyGoodCars</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <h1>Add New Listing</h1>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('cars') }}">All Cars</a>
                <a href="{{ route('my-listings') }}">My Listings</a>
                <a href="{{ route('create-listing') }}">Add Listing</a>
            </nav>
        </header>

        <main>
            <h2>List Your Car</h2>
            <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" required>
                </div>

                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" id="model" name="model" required>
                </div>

                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" id="year" name="year" required>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="mileage">Mileage (km)</label>
                    <input type="number" id="mileage" name="mileage" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="images">Images</label>
                    <input type="file" id="images" name="images[]" multiple accept="image/*">
                </div>

                <button type="submit" class="btn-primary">Add Listing</button>
            </form>
        </main>
    </div>
</body>
</html>
