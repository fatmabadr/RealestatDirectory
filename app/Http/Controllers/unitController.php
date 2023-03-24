<?php

namespace App\Http\Controllers;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\Unit_multiImages;


class unitController extends Controller
{

public function ViewAll(){
        $units=Unit::latest()->get();
        return view('units.view',compact('units'));
}


public function creare(){
   $aminities= Amenity::latest()->get();
    return view('units.create',compact('aminities'));
}



public function Save(Request $request){
//return $request;

    if ($request->file('unit_main_photo')){
        $file = $request->file('unit_main_photo');
        $fileName = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('unitImages'),$fileName);
    }
    else{$fileName='';}




    $unit=Unit::insertGetId([
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
        'mainimage'=>$fileName
                 ]);

    foreach ($request->aminity as $aminity){
        $unit = Unit::findOrFail($unit);
        $unit->amenities()->attach($aminity);
    }


//mulltiImages

if ($request->file('multi_img')){
    $images=$request->file('multi_img');
    foreach($images as $image){
         $fileName=date('YmdHp').$image->getClientOriginalName();
         $image->move(public_path('unitImages'),$fileName);
         Unit_multiImages::insert([
            'image_name'=>$fileName,
             'unit_id'=>$unit->id ,

         ]);
     }}

    $units=Unit::latest()->get();
    return view('units.view',compact('units'));}


public function edite($id){
        $unit=Unit::find($id);
        $aminities= Amenity::latest()->get();
        $Unit_multiImages=Unit_multiImages::where('unit_id',$id)->get();

        return view('units.edite',compact('unit','aminities','Unit_multiImages'));}


public function update(Request $request){

    if ($request->file('unit_main_photo')){
        $file = $request->file('unit_main_photo');
        $fileName = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('unitImages'),$fileName);
    }
    else{$fileName='';}

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
        $unit->mainimage =$fileName;
        $unit->save();

        foreach ($request->aminity as $aminity){
            $unit = Unit::findOrFail($request->id);
            $unit->amenities()->attach($aminity);
        }

if ($request->file('multi_img')){

    $images=$request->file('multi_img');
    foreach($images as $image){
         $fileName=date('YmdHp').$image->getClientOriginalName();
         $image->move(public_path('unitImages'),$fileName);
         Unit_multiImages::insert([
            'image_name'=>$fileName,
             'unit_id'=>$unit->id ,

         ]);
     }}

        $units=Unit::latest()->get();
        return view('units.view',compact('units'));}


public function delete($id){
    $unit=Unit::find($id);
    $unit->delete();
    $units=Unit::latest()->get();
    return view('units.view',compact('units'));
}


public function deleteMultipleImages($id){
    Unit_multiImages::destroy($id);
    return redirect()->back();
}


}



