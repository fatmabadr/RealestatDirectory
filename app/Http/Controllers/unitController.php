<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\Unit_multiImages;
use App\Models\ContactUs;
use Auth;
class unitController extends Controller
{


public function ViewAll(){
        $minprice=Unit::whereNotNull('price')->min('price');
        $maxprice=Unit::whereNotNull('price')->max('price');
        $minArea=Unit::whereNotNull('area')->min('area');
        $maxArea=Unit::whereNotNull('area')->max('area');
        $units=Unit::latest()->get();
        $types=Unit::DISTINCT()->get('type');
        return view('units.viewAll',compact('units','types','minprice','maxprice','minArea','maxArea'));
}


public function ViewUnit($id){
    $unit=Unit::find($id);
    $multiImages=Unit_multiImages::where('unit_id',$id)->get();
    $views= Redis::incr('unit'.$id);
    return view('units.view',compact('unit','multiImages','views'));
}


public function create(){
   $aminities= Amenity::latest()->get();
    return view('units.create',compact('aminities'));
}



public function Save(Request $request){
    if ($request->file('unit_main_photo')){
        $file = $request->file('unit_main_photo');
        $fileName = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('unitImages'),$fileName);
    }
    else{$fileName='';}



    if(Auth::user()){
        $user_id=Auth::user()->id;}
        else{$user_id=0;}

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
    $minprice=Unit::whereNotNull('price')->min('price');
    $maxprice=Unit::whereNotNull('price')->max('price');
    $minArea=Unit::whereNotNull('area')->min('area');
    $maxArea=Unit::whereNotNull('area')->max('area');
    $units=Unit::latest()->get();
    $types=Unit::DISTINCT()->get('type');
    return view('units.viewAll',compact('units','types','minprice','maxprice','minArea','maxArea'));
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

        $units=Unit::latest()->get();
        $types=Unit::DISTINCT()->get('type');
        $minprice=Unit::whereNotNull('price')->min('price');
        $maxprice=Unit::whereNotNull('price')->max('price');
        $minArea=Unit::whereNotNull('area')->min('area');
        $maxArea=Unit::whereNotNull('area')->max('area');
        return view('units.viewAll',compact('units','types','minprice','maxprice','minArea','maxArea'));
    }


public function delete($id){
    $unit=Unit::find($id);
    $unit->delete();
    $units=Unit::latest()->get();
    $minprice=Unit::whereNotNull('price')->min('price');
    $maxprice=Unit::whereNotNull('price')->max('price');
    $minArea=Unit::whereNotNull('area')->min('area');
    $maxArea=Unit::whereNotNull('area')->max('area');
    $types=Unit::DISTINCT()->get('type');
    return view('units.viewAll',compact('units','types','minprice','maxprice','minArea','maxArea'));

}


public function deleteMultipleImages($id){
    Unit_multiImages::destroy($id);
    return redirect()->back();
}


public function saveMessage(Request $request){
    ContactUs::insert([
        'user_id'=>6,
        'unit_id'=>$request->unit_id,
        'name'=>$request->name,
        'messageDetails'=>$request->messageDetails,
        'phone'=>$request->phone
    ]);
    return "message sent successfully";
}


public function myUnits($id){
    $units=Unit::where('user_id',$id)->get();
    $minprice=$units->min('price');
    $maxprice=$units->max('price');
    $minArea=$units ->min('area');
    $maxArea=$units ->max('area');
    $types=Unit::DISTINCT()->where('user_id',$id)->get('type');
    return view('units.viewAll',compact('units','types','minprice','maxprice','minArea','maxArea'));

}


public function MyMessages($id){
    $messages=ContactUs::where('user_id',$id)->get();
    return view('messages',compact('messages'));
}


public function search(Request $request){
    if($request->type != null){
         $units = DB::table('units')->whereBetween('area', [$request->minArea, $request->maxArea])->
                                      whereBetween('price', [$request->minPrice, $request->maxPrice])->
                                      wherein('type',$request->type)->get();
         }
    else {
    $units = DB::table('units')->whereBetween('area', [$request->minArea, $request->maxArea])->
                                 whereBetween('price', [$request->minPrice, $request->maxPrice])->get();
        }
    $types=Unit::DISTINCT()->get('type');
    $minprice=Unit::whereNotNull('price')->min('price');
    $maxprice=Unit::whereNotNull('price')->max('price');
    $minArea=Unit::whereNotNull('area')->min('area');
    $maxArea=Unit::whereNotNull('area')->max('area');

    return view('units.viewAll',compact('units','types','minprice','maxprice','minArea','maxArea'));

}


}

