<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Content::class;
    public function definition(): array
    {
        return [
            'judul' => fake()->name(),
            'materi' => fake()->text(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Content $content) {
            $course = Course::inRandomOrder()->first();
            $content->course_id = $course->id;
        });
    }
}
