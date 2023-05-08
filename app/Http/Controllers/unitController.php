<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\mail;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\District;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Unit_multiImages;
use App\Models\ContactUs;
use Auth;
use Image;

class unitController extends Controller
{


public function ViewAll(){



        $minimumprice=Unit::whereNotNull('price')->min('price');
        $maximumprice=Unit::whereNotNull('price')->max('price');
        $minimumArea=Unit::whereNotNull('area')->min('area');
        $maximumArea=Unit::whereNotNull('area')->max('area');
        $units=Unit::latest()->paginate(10);
       // $unitsdistrict=District::where('district_id',$units->$id)->get('name');

        $types=Unit::DISTINCT()->get('type');

        return view('units.viewAll',compact('units','types','minimumprice','maximumprice','minimumArea','maximumArea'));
}


public function ViewUnit($id){
    $unit=Unit::find($id);
    $multiImages=Unit_multiImages::where('unit_id',$id)->get();
    $views= Redis::incr('unit'.$id);

    return view('units.view',compact('unit','multiImages','views'));
}


public function create(){
    if(Auth::user()->userType==0){
     Auth::logout();
        return  redirect()->route('login')->with('succ','login as buyer');

    }
   $aminities= Amenity::latest()->get();
   $governorates= Governorate::all();
    return view('units.create',compact('aminities','governorates'));
}



public function Save(Request $request){

    if ($request->file('unit_main_photo')){
        $file = $request->file('unit_main_photo');
        $fileName = date('YmdHi').$file->getClientOriginalName();
        Image::make($request->file('unit_main_photo'))->resize(1200,1200)->save(('unitImages/').$fileName);

    }
    else{$fileName='';}
    if(Auth::user()){
        $user_id=Auth::user()->id;}
        else{$user_id=0;}

    $unit=Unit::insertGetId([
        'noofbathrooms'=>$request->noofbathrooms ,
        'noofbedrooms'=>$request->noofbedrooms ,
        'name'=>$request->name ,
        'area'=>$request->area ,
        'details'=>$request->details ,
        'price'=>$request->price ,
        'district_id'=>$request->district_id,
        'payment_type'=>$request->payment_type ,
        'building_date'=>$request->building_date ,
        'delevery_date'=>$request->delevery_date ,
        'type'=>$request->type ,
        'googleMapsLocation_url'=>$request->googleMapsLocation_url ,
        'user_id'=>$user_id,
        'mainimage'=>$fileName
                 ]);


        $unit = Unit::findOrFail($unit);
        foreach ($request->aminity as $aminity){
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
    $minimumprice=Unit::whereNotNull('price')->min('price');
    $maximumPrice=Unit::whereNotNull('price')->max('price');
    $minimumArea=Unit::whereNotNull('area')->min('area');
    $maximumArea=Unit::whereNotNull('area')->max('area');
    $units=Unit::latest()->paginate(10);;
    $types=Unit::DISTINCT()->get('type');
    return view('units.viewAll',compact('units','types','minimumprice','maximumPrice','minimumArea','maximumArea'));
}


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
    else{
        $fileName='';
        }

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

        $units=Unit::latest()->paginate(10);;
        $types=Unit::DISTINCT()->get('type');
        $minimumprice=Unit::whereNotNull('price')->min('price');
        $maximumPrice=Unit::whereNotNull('price')->max('price');
        $minimumArea=Unit::whereNotNull('area')->min('area');
        $maximumArea=Unit::whereNotNull('area')->max('area');
        return view('units.viewAll',compact('units','types','minimumprice','maximumPrice','minimumArea','maximumArea'));
    }


public function delete($id){
    $unit=Unit::find($id);
    $unit->delete();
    $units=Unit::latest()->paginate(10);;
    $minimumprice=Unit::whereNotNull('price')->min('price');
    $maximumPrice=Unit::whereNotNull('price')->max('price');
    $minimumArea=Unit::whereNotNull('area')->min('area');
    $maximumArea=Unit::whereNotNull('area')->max('area');
    $types=Unit::DISTINCT()->get('type');
    return view('units.viewAll',compact('units','types','minimumprice','maximumPrice','minimumArea','maximumArea'));

}


public function deleteMultipleImages($id){
    Unit_multiImages::destroy($id);
    return redirect()->back();
}


public function saveMessage(Request $request){

    ContactUs::insert([
        'user_id'=>$request->user_id,

        'unit_id'=>$request->unit_id,
        'name'=>$request->name,
        'messageDetails'=>$request->messageDetails,
        'phone'=>$request->phone
    ]);
    return redirect()->back()->with('succ',"message sent Successfully");
}


public function myUnits($id){
    $units=Unit::where('user_id',$id)->paginate(10);;
    $minimumPrice=0;$maximumpric=0; $minimumArea=0;  $maximumArea=0;
   // $minimumprice=$units->min('price');
    $maximumPrice=$units->max('price');
    $minimumArea=$units ->min('area');
    $maximumArea=$units ->max('area');
    $types=Unit::DISTINCT()->where('user_id',$id)->get('type');

    return view('units.viewAll',compact('units','types','minimumPrice','maximumPrice','minimumArea','maximumArea'));

}


public function MyMessages($id){
    $messages=ContactUs::where('user_id',$id)->get();
    return view('messages',compact('messages'));
}


public function search(Request $request){

    if($request->type != null){
         $units = Unit::whereBetween('area', [$request->minimumArea, $request->maximumArea])->
                                      whereBetween('price', [$request->minimumPrice, $request->maximumPrice])->
                                      wherein('type',$request->type)->paginate(10);
         }
    else {

    $units = Unit::whereBetween('area', [$request->minimumArea, $request->maximumArea])->
                                 whereBetween('price', [$request->minimumPrice, $request->maximumPrice])->paginate(10);

                                }
    $types=Unit::DISTINCT()->get('type');
    $minimumPrice=Unit::whereNotNull('price')->min('price');
    $maximumPrice=Unit::whereNotNull('price')->max('price');
    $minimumArea=Unit::whereNotNull('area')->min('area');
    $maximumArea=Unit::whereNotNull('area')->max('area');

    return view('units.viewAll',compact('units','types','minimumPrice','maximumPrice','minimumArea','maximumArea'));

}

public function Sortby(Request $request){
    if($request->Sort=='priceHigh'){
        $units=Unit::all()->sortByDesc("price");
    }
    if($request->Sort=='pricelow'){
        $units=Unit::all()->sortBy("price");
    }
    if($request->Sort=='areaLarge'){
        $units=Unit::all()->sortByDesc("area");
    }

    if($request->Sort=='areasmall'){
        $units=Unit::all()->sortBy("area")->paginate(10);;
    }
//

    $minimumprice=Unit::whereNotNull('price')->min('price');
    $maximumPrice=Unit::whereNotNull('price')->max('price');
    $minimumArea=Unit::whereNotNull('area')->min('area');
    $maximumArea=Unit::whereNotNull('area')->max('area');
    $types=Unit::DISTINCT()->get('type');
    return view('units.viewAll',compact('units','types','minimumprice','maximumPrice','minimumArea','maximumArea'));
}




public function home(){

    $minimumPrice=Unit::whereNotNull('price')->min('price');
    $maximumPrice=Unit::whereNotNull('price')->max('price');
    $minimumArea=Unit::whereNotNull('area')->min('area');
    $maximumArea=Unit::whereNotNull('area')->max('area');
    $types=Unit::DISTINCT()->get('type')->take(5);


    return view('Home',compact('types','minimumPrice','maximumPrice','minimumArea','maximumArea'));
}
}




