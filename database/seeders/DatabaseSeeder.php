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
use App\Models\MoneybirdContact;

use App\Http\Controllers\MoneybirdController;

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
            'moneybird_id' => '376587614757586698',
        ]);

        Opdracht::factory()->count(10)->create([
            'klant_moneybird_id' => '376587614757586698',
        ]);

        // Store the contact in moneybird_contacts
        $contact = new MoneybirdContact();
        MoneybirdController::updateOrStoreContact(376587614757586698);
    }
}
