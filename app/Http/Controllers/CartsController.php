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
        $balance = (User::$judgment_value)-((\Auth::user()->total)%(User::$judgment_value));
        $neo_balance = $balance - User::moneyOfCart();
        return view('carts.contents')
            ->with('goods',\Auth::user()->feed_carts())
            ->with('count_goods',User::countCarts())
            ->with('neo_balance',$neo_balance);
    }
    
    public function settle(){
        return view('carts.settle')
                ->with('goods',\Auth::user()->feed_carts());
    }
    
    public function settled(Request $request){
        $request->validate([
            'card_num' => ['required', 'digits_between:13,16'],
            'password' => ['required'],
            ]);
        User::deleteCartsGoods();
        User::promoteRank(User::storeSum());
        return view('carts.settled');
    }
    
    public function deleteCartsGood(Request $request){
        \Auth::user()->deleteCartsGood($request->good_id);
        return redirect()->route('cart.contents');
    }


}
