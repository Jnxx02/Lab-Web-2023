<?php

namespace App\Models;

use App\Models\Content;
use App\Models\ProgressRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_Course extends Model {
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_id',
    ];

    public function contents() {
        return $this->hasMany(Content::class);
    }

    public function progressRecords() {
        return $this->hasMany(ProgressRecord::class, 'student__course_id');
    }

}
