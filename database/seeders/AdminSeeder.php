<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('ADMIN_PASSWORD', 'password');
        $email    = 'admin@admin.com';

        if (!User::where('email', $email)->exists()) {
            User::create([
                'name'     => 'Administrateur',
                'email'    => $email,
                'password' => Hash::make($password),
            ]);
            $this->command->info("Admin créé : {$email}");
        } else {
            // Met à jour le mot de passe si ADMIN_PASSWORD a changé
            User::where('email', $email)->update([
                'password' => Hash::make($password),
            ]);
            $this->command->info("Admin mis à jour : {$email}");
        }
    }
}