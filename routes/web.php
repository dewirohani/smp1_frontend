<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    HomeController, StudentClassController, StudentController
};

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
Route::get('/', function () {
    $auth = Http::withHeaders([
        'Authorization' => 'Bearer '.request()->cookie('token'),
        'ContentType' => 'application/json',
        'Accept' => 'application/json',
    ])->get('http://127.0.0.1:8000/api/user')->json();
    if ($auth['message'] != "Authenticated.") {
        return view('auth.login');
    }else{
        return redirect()->to('/home');
    }
});

Route::middleware(['authenticated'])->group(function (){

    Route::get('/home',                          [HomeController::class, 'index'])->name('home');   
    
    Route::get('/student-classes',               [StudentClassController::class, 'index'])->name('student-classes.index');   
    Route::get('/student-classes/create',        [StudentClassController::class, 'create'])->name('student-classes.create');   
    Route::get('/student-classes/edit',          [StudentClassController::class, 'edit'])->name('student-classes.edit');   

    Route::get('/students',                      [StudentController::class, 'index'])->name('students.index');   
    Route::get('/students/create',               [StudentController::class, 'create'])->name('students.create');   
    Route::get('/students/edit',                 [StudentController::class, 'edit'])->name('students.edit');   

// Route::get('/', function () {
//     return view('app');
});

