<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('progress_records', function (Blueprint $table) {
            $table->id();
            $table->decimal('progress', 5, 2)->default(0);
            $table->foreignId('content_id')
                ->constrained('contents', 'id')
                ->onDelete('cascade');

            $table->foreignId('student__course_id')
                ->constrained('student__courses', 'student_id')
                ->where('role', 'student')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('progress_records');
    }
};
