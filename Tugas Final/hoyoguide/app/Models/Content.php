<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'materi',
        'course_id',
    ];

    public function progressRecords()
    {
        return $this->hasMany(ProgressRecord::class);
    }
}
