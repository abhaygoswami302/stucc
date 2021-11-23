<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $flag = $this->faker->randomElement(['1', '2', '3']);
        if($flag == '1'){
            $membership = 'Basic';
        }elseif($flag == '2'){
            $membership = 'Standard';
        }elseif($flag == '3'){
            $membership = 'Premium';
        }
        return [
            'flag' => $flag,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'membership' => $membership,
            'image' =>  $this->faker->randomElement(['admin\img\undraw_profile.svg', 'admin\img\undraw_profile_1.svg', 'admin\img\undraw_profile_2.svg', 'admin\img\undraw_profile_3.svg']),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
