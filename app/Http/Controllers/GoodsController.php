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
    
    
    
   public function index()
   {
        $goods = Good::all();
        return view('goods.index')->with('goods',$goods);;
    }
    
    
    
    

    public function create(Request $request)
    {   
        // dd($request);
        //dump($request);
        $data = $request;
        $good = new Good;
        $good -> addGood($data);
        return view('goods.create');
    }
    

    public function detail(Request $request)
    {   
        $user = \Auth::user();
        $isExist = $user->isGoodInCarts($request->good_id);
        if($isExist==false){
            $good = Good::findOrFail($request->good_id);
        }
        else{
            $good = $user->getGoodDetail($request->good_id)[0];
        };
        
        // dd($good);
        // dd($isExist);
        // $quantity = $user->getQuantity($request->good_id);
        // dd($quantity);
        return view('goods.detail')->with('good',$good)->with('added_quantity')->with('exist',$isExist);//withでぶん投げる
    }
    
    public function detail_2($good_id)
    {   
        $user = \Auth::user();
        $isExist = $user->isGoodInCarts($good_id);
        if($isExist==false){
            $good = Good::findOrFail($good_id);
        }
        else{
            $good = $user->getGoodDetail($good_id)[0];
        };
        return view('goods.detail')->with('good',$good)->with('added_quantity')->with('exist',$isExist);//withでぶん投げる
    }
    
    
    
        public function addCarts(Request $request)
    {   
        $user = \Auth::user();
        $user->addCarts($request->good_id,$request->quantity);
        // $isExist = $user->isGoodInCarts($request->good_id);
        // if($isExist==false){
        //     $good = Good::findOrFail($request->good_id);
        // }
        // else{
        $good = $user->getGoodDetail($request->good_id)[0];
        // };
        return view('goods.detail')->with('good',$good)->with('added_quantity',$request->quantity)->with('exist',true);;
    }
    
    
    
    
        public function changeQuantity(Request $request)
    {   
        $user = \Auth::user();
         $user->changeQuantity($request->good_id,$request->quantity); 
        // $isExist = $user->isGoodInCarts($request->good_id);
        // if($isExist==false)
        // {
        //     $good = Good::findOrFail($request->good_id);
        // }
        // else
        // {
            $good = $user->getGoodDetail($request->good_id)[0];
        // };
        return view('goods.detail')->with('good',$good)->with('added_quantity',$request->quantity)->with('exist',true);;
    }
}
