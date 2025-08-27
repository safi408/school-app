<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
        protected $fillable = [
        'subject_name',
        'class_id',
        'teacher_id',
    ];
        public function SchoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id'); // Change ClassModel to your actual class model name
    }

    public function Teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

}
