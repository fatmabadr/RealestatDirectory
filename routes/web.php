<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\http\Controllers\unitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    route::get('/hi',[unitController::class,'ViewAll'])->name('Units.view.all');

    Route::get('/', function () {
        return view('Home');});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::prefix('units')->group(function(){
    route::get('home',[unitController::class,'home'])->name('unit.home.page');

    route::get('view/all',[unitController::class,'ViewAll'])->name('Units.view.all');
    route::get('view/unit/{id}',[unitController::class,'ViewUnit'])->name('Unit.view');
    route::get('view/myUnits/{id}',[unitController::class,'myUnits'])->name('my.units');
    route::get('create',[unitController::class,'create'])->name('create.new.unit');
    route::post('save',[unitController::class,'save'])->name('unit.save');
    route::get('edite/{id}',[unitController::class,'edite'])->name('unit.edite');
    route::post('update',[unitController::class,'update'])->name('unit.update');
    route::get('delete/{id}',[unitController::class,'delete'])->name('unit.delete');
    route::get('add/amenity/{id}',[unitController::class,'addAmenities'])->name('unit.add.amenity');
    route::post('multiImagesofUnit/save',[unitController::class,'updateMultipleImages'])->name('unit.multiImages.update');
    route::get('multiImagesofUnit/delete/{id}',[unitController::class,'deleteMultipleImages'])->name('unit.image.delete');
    route::post('message/save',[unitController::class,'saveMessage'])->name('massege.save');
    route::get('mymessage/{id}',[unitController::class,'MyMessages'])->name('my.messages');
    route::post('search/',[unitController::class,'search'])->name('units.search');
    route::post('Sortby/',[unitController::class,'Sortby'])->name('units.Sort');
    route::post('searcrrh/',[unitController::class,'searchArea'])->name('units.search.area');



});

