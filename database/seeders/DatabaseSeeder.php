<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user from factory
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin', // Add role if needed
        ]);

        // Create your specific dummy user
        User::create([
            'name' => 'mas akbar',
            'email' => 'akbar@gmail.com',
            'role' => 'operator',
            'password' => Hash::make('12345')
        ]);

        // Uncomment if you want to create multiple random users
        // User::factory(10)->create();
    }
}