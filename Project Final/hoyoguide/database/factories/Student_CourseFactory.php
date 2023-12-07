<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use App\Models\Content;
use App\Models\Student_Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student_Course>
 */
class Student_CourseFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student_Course::class;
    protected $table = 'student__courses';
    public function definition(): array {
        $studentId = User::where('role', 'student')->inRandomOrder()->first()->id;

        $courseId = Course::inRandomOrder()->first()->id;

        return [
            'student_id' => $studentId,
            'course_id' => $courseId,
        ];
    }
}
