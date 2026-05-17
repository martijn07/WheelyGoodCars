<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::query()
            ->with('tags')
            ->whereNull('sold_at')
            ->orderByDesc('updated_at')
            ->get();

        $highlightedCarIds = $cars->pluck('id')->shuffle()->take(min(3, $cars->count()))->all();

        return view('cars', compact('cars', 'highlightedCarIds'));
    }

    public function show(Car $car)
    {
        abort_if($car->sold_at !== null, 404);

        Car::query()
            ->whereKey($car->id)
            ->update(['views' => $car->views + 1]);

        $car->refresh()->load('tags', 'user');

        return view('car-detail', compact('car'));
    }

    public function create(Request $request)
    {
        if ($request->boolean('reset')) {
            session()->forget('listing_draft');
        }

        $draft = session('listing_draft');

        if ($draft) {
            return view('create-listing', [
                'step' => 2,
                'licensePlate' => $draft['licensePlate'],
                'carData' => $draft['carData'],
                'availableTags' => Tag::query()->orderBy('name')->get(),
            ]);
        }

        return view('create-listing', ['step' => 1]);
    }

    public function verifyLicensePlate(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|max:255',
        ]);

        $licensePlate = $this->normalizeLicensePlate($request->license_plate);

        $carData = $this->fetchCarData($licensePlate);

        session()->put('listing_draft', [
            'licensePlate' => $licensePlate,
            'carData' => $carData,
        ]);

        return redirect()->route('create-listing');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'seats' => 'nullable|integer|min:1',
            'doors' => 'nullable|integer|min:1',
            'production_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'weight' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $tagIds = $validated['tags'] ?? [];
        unset($validated['tags']);

        $validated['user_id'] = Auth::id();
        $validated['license_plate'] = $this->normalizeLicensePlate($validated['license_plate']);

        $car = Car::create($validated);

        if (! empty($tagIds)) {
            $car->tags()->sync($tagIds);
        }

        session()->forget('listing_draft');

        return redirect()->route('my-listings')->with('success', 'Car listing created successfully!');
    }

    public function myListings()
    {
        $cars = Auth::user()->cars()->with('tags')->orderBy('updated_at', 'desc')->get();

        return view('my-listings', compact('cars'));
    }

    public function destroy(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $car->delete();

        return redirect()->route('my-listings')->with('success', 'Car listing deleted successfully!');
    }

    private function fetchCarData($licensePlate)
    {
        try {
            $response = Http::timeout(5)
                ->acceptJson()
                ->get('https://opendata.rdw.nl/resource/m9d7-ebf2.json', [
                    'kenteken' => strtolower($licensePlate),
                ]);

            if ($response->successful()) {
                $record = $response->json()[0] ?? null;

                if (is_array($record)) {
                    $productionDate = $record['datum_eerste_toelating'] ?? null;

                    return [
                        'make' => $record['merk'] ?? '',
                        'model' => $record['handelsbenaming'] ?? '',
                        'production_year' => $productionDate ? (int) substr((string) $productionDate, 0, 4) : '',
                        'color' => $record['eerste_kleur'] ?? '',
                        'seats' => $record['zitplaatsen'] ?? '',
                        'doors' => $record['aantal_deuren'] ?? '',
                        'weight' => $record['massa_ledig_voertuig'] ?? '',
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Fall back to an empty draft when the RDW API is unavailable.
        }

        return [
            'make' => '',
            'model' => '',
            'production_year' => '',
            'color' => '',
            'seats' => '',
            'doors' => '',
            'weight' => '',
        ];
    }

    private function normalizeLicensePlate(string $licensePlate): string
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $licensePlate) ?? '');
    }
}
