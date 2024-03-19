<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account' => '20' . rand(15, 21) . rand(1000, 9999),
            'name' => $this->faker->name(),
            'university' => $this->faker->name . '대학교',
            'department' => $this->faker->name . '학과',
            'grade' => rand(1, 4),
            'academic' => '재학',
            'phone_number' => '010-' . rand(1000, 9999) . '-' . rand(1000, 9999),
            'number' => '',
            'email_verified_at' => now(),
            'email' => $this->faker->email,
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'year' => $this->faker->year . $this->faker->month . rand(1, 30),
            'gender' => rand(1, 2),
            'line' => $this->faker->name . '대학',
            'type' => '학사',
            'grade_score' => rand(1.0, 4.5),
            'remember_token' => Str::random(32),
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
