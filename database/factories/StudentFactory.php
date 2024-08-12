<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'student_number' => $this->faker->unique()->numberBetween(4000, 9999),
            'student_id' => $this->faker->unique()->numberBetween(100000, 999999),
            'fullname' => $this->faker->name,
            'studyprogram_id' => $this->faker->numberBetween(1, 10),
            'student_school_year' => $this->faker->year,
            'student_type_id' => $this->faker->numberBetween(1, 5),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }
}
