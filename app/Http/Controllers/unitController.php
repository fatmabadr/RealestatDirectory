<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use Illuminate\Http\Request;

class unitController extends Controller
{

    public function ViewAll(){
        $units=Unit::latest()->get();
        return view('units.view',compact('units'));
}


public function creare(){
    return view('units.create');
}



public function Save(Request $request){

    Unit::insert([
        'name'=>$request->name ,
        'area'=>$request->area ,
        'details'=>$request->details ,
        'price'=>$request->price ,
        'payment_type'=>$request->payment_type ,
        'building_date'=>$request->building_date ,
        'delevery_date'=>$request->delevery_date ,
        'type'=>$request->type ,
        'googleMapsLocation_url'=>$request->googleMapsLocation_url ,
        'user_id'=>7 ,
                 ]);
    $units=Unit::latest()->get();
    return view('units.view',compact('units'));}


public function edite($id){
    $unit=Unit::find($id);
   return view('units.edite',compact('unit'));}


public function update(Request $request){
        $unit=Unit::find($request->id);
        $unit->name=$request->name;
        $unit->area=$request->area;
        $unit->details=$request->details;
        $unit->price=$request->price;
        $unit->payment_type=$request->payment_type;
        $unit->type=$request->type;
        $unit->delevery_date=$request->delevery_date;
        $unit->building_date=$request->building_date;
        $unit->googleMapsLocation_url=$request->googleMapsLocation_url;
        $unit->save();
        $units=Unit::latest()->get();
        return view('units.view',compact('units'));}


public function delete($id){
    $unit=Unit::find($id);
    $unit->delete();
    $units=Unit::latest()->get();
    return view('units.view',compact('units'));
}


}
