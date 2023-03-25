<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function Unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');}

        public function User(){
            return $this->belongsTo(User::class,'user_id','id');}

}
