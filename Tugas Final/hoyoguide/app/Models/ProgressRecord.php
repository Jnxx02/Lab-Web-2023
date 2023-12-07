<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressRecord extends Model {
    use HasFactory;

    protected $fillable = [
        'content_id',  
        'student__course_id', 
        'progress',
    ];
    public function content() {
        return $this->belongsTo(Content::class);
    }
}
