<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder tambahan untuk data awal sistem SI-XXI
        $this->call([
            RoleSeeder::class,
            GenreSeeder::class,
        ]);

        // Buat akun admin default
        $admin = User::factory()->create([
            'name' => 'Admin SI-XXI',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // id 1 = role admin (dari RoleSeeder)
        ]);

        // Buat user biasa contoh
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2, // id 2 = role user (dari RoleSeeder)
        ]);
    }
}
