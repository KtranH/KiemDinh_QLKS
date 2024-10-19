<?php

namespace App\Http\Middleware;

use App\QueryDB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    use QueryDB;
    public function handle(Request $request, Closure $next): Response
    {
        if(!Cookie::has('tokenLogin'))
        {
            return redirect()->route('showlogin');
        }
        else
        {
            $user = $this->Inf_User(Cookie::get('tokenLogin'));
            if($user[0]['IsDelete'] == 1)
            {
                return redirect()->route('showlogin')->with('error', 'Tài khoản của bạn đã bị khóa');
            }
            else
            {
                return $next($request);
            }
        }
    }
}
