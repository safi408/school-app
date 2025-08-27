<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model

{
    //
    protected $fillable = ['class_name'];

    public function Student()

    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
