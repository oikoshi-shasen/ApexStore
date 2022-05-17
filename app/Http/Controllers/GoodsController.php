<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Good;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class GoodsController extends Controller
{
    
    
    
   public function index(){
        return view('goods.index')
            ->with('goods',Good::all());;
    }
    
    
    
    

    public function create(Request $request){   
        $good = new Good;
        $good -> addGood($request);
        return view('goods.create');
    }
    
    public function detail(Request $request)
    {   
        $isExist = \Auth::user()->isGoodInCarts($request->good_id);
        if($isExist==false){
            $good = Good::findOrFail($request->good_id);
        }
        else{
            $good = User::getGoodDetail($request->good_id);
        };
        return view('goods.detail')->with('good',$good)->with('added_quantity')->with('exist',$isExist);//withでぶん投げる
    }

    
    
        public function addCarts(Request $request)
    {   
        User::addCarts($request->good_id,$request->quantity,$request->good_price);
        $good = User::getGoodDetail($request->good_id);
        return view('goods.detail')
                ->with('good',$good)
                ->with('added_quantity',$request->quantity)
                ->with('exist',true);;
    }
    
    
    
    
        public function changeQuantity(Request $request)
    {   
         User::changeQuantity($request->good_id,$request->quantity,$request->good_price); 
         $good = User::getGoodDetail($request->good_id);
        return view('goods.detail')
                ->with('good',$good)
                ->with('added_quantity',$request->quantity)
                ->with('exist',true);;
    }
}
