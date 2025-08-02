<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+6 months');

        return [
            'customer_id' => Customer::factory(),
            'name' => $this->faker->randomElement([
                'Web Development',
                'Mobile App Development',
                'E-commerce Solution',
                'Database Design',
                'API Development',
                'System Integration',
                'Technical Consultation',
                'Performance Optimization',
                'Security Audit',
                'Maintenance Package'
            ]),
            'description' => $this->faker->paragraph(3),
            'type' => $this->faker->randomElement(['consultation', 'development', 'maintenance', 'support', 'training', 'other']),
            'price' => $this->faker->randomFloat(2, 500, 10000),
            'status' => $this->faker->randomElement(['active', 'inactive', 'pending', 'completed']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'duration_hours' => $this->faker->numberBetween(10, 500),
            'features' => $this->faker->randomElements([
                'Responsive Design',
                'SEO Optimization',
                'Admin Panel',
                'User Authentication',
                'Payment Integration',
                'Real-time Updates',
                'Mobile Optimization',
                'Third-party APIs',
                'Analytics Integration',
                'Security Features'
            ], $this->faker->numberBetween(2, 5)),
            'notes' => $this->faker->optional()->sentence()
        ];
    }

    /**
     * Indicate that the service is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the service is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the service is development type.
     */
    public function development(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'development',
        ]);
    }
}
