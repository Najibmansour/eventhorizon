<?php

namespace Database\Seeders;

use App\Models\EventPost;
use App\Models\User;
use Database\Factories\EventPostFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        EventPost::factory(10)->create();
    }
}
