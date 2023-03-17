<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

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
    route::get('view/all',[unitController::class,'ViewAll'])->name('MyUnits.view');
    route::get('creare',[unitController::class,'creare'])->name('add.new.unit');
    route::post('newUnit/save',[unitController::class,'save'])->name('unit.save');
    route::get('edit/{id}',[unitController::class,'edite'])->name('unit.edite');
    route::post('Unit/update',[unitController::class,'update'])->name('unit.update');
    route::get('delete/{id}',[unitController::class,'delete'])->name('unit.delete');

});
