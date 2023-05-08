<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Governorate;
use App\Models\City;

class AreaController extends Controller
{

    public function getallcitiesofgoveronrate($governorate_id){
        $cities = City::where('governorate_id',$governorate_id)->orderby('name','DESC')->get();
return json_decode($cities);
    }


    public function getalldistrictofcity($city_id){
        $districts=District::where('city_id',$city_id)->orderby('name','DESC')->get();
        return json_decode($districts);
    }
}
