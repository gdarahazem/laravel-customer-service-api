<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing customers
        $customers = Customer::all();

        if ($customers->count() === 0) {
            // Create some customers first if none exist
            $customers = Customer::factory()->count(10)->create();
        }

        // Create services for existing customers
        $customers->each(function ($customer) {
            // Each customer gets 1-2 services
            Service::factory()
                ->count(rand(1, 2))
                ->create(['customer_id' => $customer->id]);
        });

        // Create some additional standalone services
        Service::factory()->count(20)->create();
    }
}
