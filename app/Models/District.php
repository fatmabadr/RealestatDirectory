<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Governorate(){
        return $this->belongsTo(Governorate::class,'governorate_id','id');

}
public function City(){
    return $this->belongsTo(City::class,'city_id','id');
}

}
