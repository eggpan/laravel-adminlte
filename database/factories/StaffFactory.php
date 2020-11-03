<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'locale' => mt_rand(0, 1) === 1 ? 'ja' : 'en',
            'remember_token' => Str::random(10),
        ];
    }
}
