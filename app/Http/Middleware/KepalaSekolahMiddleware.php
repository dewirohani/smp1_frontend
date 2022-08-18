<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class KepalaSekolahMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = Http::withHeaders([
            'Authorization' => 'Bearer '.$request->cookie('token'),
            'ContentType' => 'application/json',
            'Accept' => 'application/json',
        ])->get('http://127.0.0.1:8000/api/user')->json();
        
        $user = json_decode(json_encode($auth))->data;
    
        if ($user->level_id != 2) {
            return redirect()->to('/login');
        }
        return $next($request);
    }
}
