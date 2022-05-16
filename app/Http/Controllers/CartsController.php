<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Good;
use App\Rank;
use App\Cart;


class CartsController extends Controller
{
    public function contentsOfCart(){
        $user = \Auth::user();
        $goods = $user->feed_carts();
        $count_goods = $user->countCarts();
        $money_of_cart = $user->moneyOfCart();
        $balance = (User::$judgment_value)-((\Auth::user()->total)%(User::$judgment_value));
        $neo_balance = $balance - $money_of_cart;
        return view('carts.contents')
            ->with('goods',$goods)
            ->with('count_goods',$count_goods)
            ->with('neo_balance',$neo_balance);
    }
    
    public function settle(){
        $user = \Auth::user();
        $goods = $user->feed_carts();
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
        $total = $user->storeSum();
        $user->promoteRank($total);
        return view('carts.settled');
    }
    
        public function deleteCartsGood(Request $request){
        $user = \Auth::user();
        $user->deleteCartsGood($request->good_id);
        return redirect()->route('cart.contents');
        }


}
