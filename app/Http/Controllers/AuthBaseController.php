<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
class AuthBaseController extends Controller
{
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      if (Auth::check()) {
        return $next($request);
      } else {
        return redirect('/');
      }
    });
  }
}
