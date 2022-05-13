<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Good;


class CartsController extends Controller
{
    public function contentsOfCart(){
        $user = \Auth::user();
        $goods = $user->feed_carts();
        // Auth::user()->inCarts as $good
        $count_goods = $user->countCarts();
        return view('carts.contents')->with('goods',$goods)->with('count_goods',$count_goods);
    }
    
    public function settle(){
        $user = \Auth::user();
        $goods = $user->feed_carts();
        // ->orderBy('created_at','desc');
        // dd($goods);
        return view('carts.settle')->with('goods',$goods);
    }
    
    public function settled(Request $request){
        $user = \Auth::user();
        $request->validate([
            'card_num' => ['required', 'digits_between:13,16'],
            'password' => ['required'],
            ]);
        $goodIds = $user->feedGoodIds();
        $user->deleteCartsGoods($goodIds);
        return view('carts.settled');
    }
    
        public function deleteCartsGood(Request $request){
        $user = \Auth::user();
        $user->deleteCartsGood($request->good_id);
        return redirect()->route('cart.contents');
        }


}
