<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'units_amenities', 'amenities_id', 'units_id');
    }
}
