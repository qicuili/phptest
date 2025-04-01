<?php

namespace App\Http\Controllers;
class AdminController extends AuthBaseAdminController
{
    public function index(){
        return view('Admin.index');
    }
    
}
