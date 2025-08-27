<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class);
}

public function teacher()
{
    return $this->belongsTo(Teacher::class);
}

}
