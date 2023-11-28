<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Payment;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // Child::factory(50)->create();
        // Sponsor::factory(10)->create();
        Payment::factory(200)->create();
    }
}
