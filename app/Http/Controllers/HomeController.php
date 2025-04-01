<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function home(Request $request)
    {
        return view('home', [
            "page" => 'home',
            "route"=>"/"
        ]);
    }
    public function delete(Request $request)
    {
        return view('delete', [
            "page" => 'delete',
             "route"=>"/object-deletion"
        ]);
    }
    public function redraw(Request $request)
    {
        return view('redraw', [
            "page" => 'redraw',
             "route"=>"/draw-similarities"

        ]);
    }   
}
