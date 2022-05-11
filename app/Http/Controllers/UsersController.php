<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    
    
    
    
    public function detail(){
        $user = \Auth::user();
        return view('users.detail')->with('user',$user);
    }
        
}
