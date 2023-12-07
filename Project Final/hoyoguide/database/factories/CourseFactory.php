<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class;
    public function definition(): array {
        $tanggalMulai = now();
        $tanggalSelesai = fake()->dateTimeBetween($tanggalMulai, '+30 days')->format('Y-m-d');

        return [
            'course_name' => fake()->name(),
            'deskripsi' => fake()->text(),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
        ];
    }

    public function configure() {
        return $this->afterMaking(function (Course $course) {
            $teacher = User::where('role', 'teacher')->inRandomOrder()->first();
            $course->teacher_id = $teacher->id;
        });
    }
}
