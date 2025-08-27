<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'day_of_week',
        'start_time',
        'end_time',
        'room_number',
    ];

    public function SchoolClass()
    {
    return $this->belongsTo(SchoolClass::class, 'class_id'); // Replace with actual class model name
    }

    public function Course()
    {
         return $this->belongsTo(Course::class, 'subject_id');
    }

    public function Teacher()
    {
      return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
