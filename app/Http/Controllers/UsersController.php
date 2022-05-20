<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    
    public function detail(){
        return view('users.detail')
                ->with('user',User::detailUser());
    }
    
    public function history(){
        return view('users.history')
            ->with('historys',User::getHistory())
            ->with('user',User::detailUser());
    }    
    
    public function topPage(){
        if (\Auth::check()==true){
            return redirect()->route('goods_index');
        } 
        else{
            return view('welcome');
        }
    }
}
