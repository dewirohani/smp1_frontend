<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {       
        $auth = Http::withHeaders([
            'Authorization' => 'Bearer '.request()->cookie('token'),
            'ContentType' => 'application/json',
            'Accept' => 'application/json',
        ])->get('http://127.0.0.1:8000/api/user')->json();
        
        $auth = json_decode(json_encode($auth))->data;
        
        if ($auth->level_id == 1) {
            return view('admin.home');    
        } else if ($auth->level_id == 2) {
            return view('kepalasekolah.home');
        } else if ($auth->level_id == 3) {
            return view('walikelas.home');
        } else if ($auth->level_id == 4) {
            return view('kepegawaian.home');
        } else if ($auth->level_id == 5) {
            return view('kesiswaan.home');
        }
    }

    
}
