<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create test user from environment variables
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');
        
        if ($adminEmail && $adminPassword) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
            ]);
            
            $this->command->info("Admin user created with email: {$adminEmail}");
        } else {
            // Fallback test user
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            
            $this->command->info('Test user created with email: test@example.com (password: password)');
        }
    }
}
