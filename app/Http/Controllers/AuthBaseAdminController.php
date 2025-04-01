<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
class AuthBaseAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->type == 'admin') {
                return $next($request);
            } else {
                return redirect('/');
            }
        });
    }
}
