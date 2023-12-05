<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class;
    public function definition(): array
    {
        return [
            'course_name' => fake()->name(),
            'deskripsi' => fake()->text(),
            'tanggal_mulai' => fake()->date(),
            'tanggal_selesai' => fake()->date(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Course $course) {
            $teacher = User::where('role', 'teacher')->inRandomOrder()->first();
            $course->teacher_id = $teacher->id;

            $student = User::where('role', 'student')->inRandomOrder()->first();
            $course->student_id = $student->id;
        });
    }
}
