<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'teacher_id',
        'student_id',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'student_id')
            ->withTimestamps();
    }
}
