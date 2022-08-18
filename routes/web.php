<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    HomeController
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

// Route::get('/', function () {
//     return view('app');
});

