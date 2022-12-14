<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Role::factory()->create([
            'name' => 'Super Admin'
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'General User'
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'Affiliations'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'role_id' => Role::ROLE_ADMIN,
            'refer_code' => Str::random(10),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
