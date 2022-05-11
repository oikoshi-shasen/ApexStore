<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    
    
    
    
    
    public function detail(){
        $user = \Auth::user();
        $rank = $user->rank()->rank;
        return view('users.detail')->with('user',$user)->with('rank',$rank);
    }
        
}
