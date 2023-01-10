<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
Use \Carbon\Carbon;

use App\Models\User;
use App\Models\Opdracht;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create test users
        $admin = User::factory()->create([
            'email' => 'valentijnvanwinden@gmail.com',
        ]);
        $admin->assignRole($adminRole);

        $planner = User::factory()->create([
            'email' => 'planner@gmail.com',
            'moneybird_id' => '1234012938102938',
        ]);

        Opdracht::factory()->count(10)->create([
            'klant_moneybird_id' => '1234012938102938',
        ]);
    }
}
