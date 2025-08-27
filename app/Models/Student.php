<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
        protected $fillable = [
        'name',
        'email',
        'class_id',
        'roll_number',
        'image',
        'phone',
    ];

    public function SchoolClass(){
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // app/Models/Student.php

public function attendances()
{
    return $this->hasMany(Attendance::class);
}

}
