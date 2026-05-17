<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ]);

        $tags = [
            ['name' => 'Sport', 'color' => '#ef4444'],
            ['name' => 'Comfort', 'color' => '#0f766e'],
            ['name' => 'Premium', 'color' => '#7c3aed'],
            ['name' => 'Zuinig', 'color' => '#16a34a'],
            ['name' => 'Automaat', 'color' => '#2563eb'],
            ['name' => 'Handgeschakeld', 'color' => '#475569'],
            ['name' => 'Elektrisch', 'color' => '#0ea5e9'],
            ['name' => 'Hybride', 'color' => '#14b8a6'],
            ['name' => 'Cabrio', 'color' => '#f97316'],
            ['name' => 'SUV', 'color' => '#8b5cf6'],
            ['name' => 'Station', 'color' => '#6366f1'],
            ['name' => 'Sedan', 'color' => '#334155'],
            ['name' => 'Familie', 'color' => '#22c55e'],
            ['name' => 'Jong gebruikt', 'color' => '#06b6d4'],
            ['name' => 'Dealeronderhouden', 'color' => '#3b82f6'],
            ['name' => 'Lage kilometerstand', 'color' => '#84cc16'],
            ['name' => 'Nette staat', 'color' => '#eab308'],
            ['name' => 'Trekhaak', 'color' => '#dc2626'],
            ['name' => 'Lease', 'color' => '#9333ea'],
            ['name' => 'Btw-auto', 'color' => '#1d4ed8'],
        ];

        foreach ($tags as $tag) {
            Tag::query()->updateOrCreate(
                ['name' => $tag['name']],
                ['color' => $tag['color']]
            );
        }
    }
}
