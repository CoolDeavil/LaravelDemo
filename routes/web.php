<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[DemoController::class,'index'])->name('DemoController.index');
Route::get('/about',[DemoController::class,'about'])->name('DemoController.about');
Route::get('/portfolio',[DemoController::class,'other'])->name('DemoController.other');

Route::get('/drop-down/option-one',[DemoController::class,'dropDownOne'])->name('DemoController.dropDownOne');
Route::get('/drop-down/option-two',[DemoController::class,'dropDownTwo'])->name('DemoController.dropDownTwo');
Route::get('/drop-down/option-tree',[DemoController::class,'dropDownTree'])->name('DemoController.dropDownTree');
Route::get('/drop-down/option-four',[DemoController::class,'dropDownFour'])->name('DemoController.dropDownFour');



Route::post('/api-language',[DemoController::class,'switchLang'])->name('DemoController.switchLang');;

