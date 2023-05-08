<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'units_amenities', 'units_id', 'amenities_id');
    }

    public function district()
    {

            return $this->belongsTo(District::class, 'district_id', 'id');
        }
    }

