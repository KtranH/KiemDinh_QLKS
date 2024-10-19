<?php

namespace App\Http\Middleware;

use App\Models\NguoiDung;
use App\QueryDB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    use QueryDB;
    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->Inf_User(Cookie::get('tokenLogin'));
        if($user[1]['TenQuyenHan'] === "Super Admin")
        {
            return $next($request);
        }
        else
        {
            return response()->view('errors.404');
        }
    }
}
