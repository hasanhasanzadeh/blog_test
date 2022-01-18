<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        if (Auth::check()){
            $user= Auth::user();
            if ($user->isAdmin() ){
                return $next($request);
            }
            else{
                return response()->json([
                    'data'=>'Forbidden ',
                    'status'=>'error'
                ],403);
            }
        }
        else{
            return response()->json([
                'data'=>'Unauthorized ',
                'status'=>'error'
            ],401);
        }
    }
}
