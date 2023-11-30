<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course-name',
        'deskripsi',
        'tanggal-mulai',
        'tanggal-selesai',
        'pengajar',
    ];
}
