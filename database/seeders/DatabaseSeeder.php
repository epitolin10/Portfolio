<?php

namespace Database\Seeders;

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

        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::factory()->create([
                'name' => 'Administrateur',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'), // Mot de passe : password
            ]);
        }

        $this->call([
            CompetenceSeeder::class,
        ]);
    }
}
