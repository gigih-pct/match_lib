<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            BookSeeder::class,
        ]);

        // Create a default admin user for server
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@mindmatch.com'],
            ['name' => 'Server Admin', 'password' => bcrypt('password')]
        );
    }
}
