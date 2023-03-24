<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_multiImages extends Model
{
    use HasFactory;

public function Unit(){
    return $this->belongsTo(Unit::class,'unit_id','id');
}
}
