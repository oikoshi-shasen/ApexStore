<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','rank_num','total','created_at', 'first_rank_num'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
     
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    static public $judgment_value = 500000;

    
    public function inCarts(){
        return $this->belongsToMany(Good::class,'carts','user_id','good_id')
            ->withPivot(['quantity','sub_total','settled_flag','id','good_id']);
    }
    
    static  public function myCarts(){
        return \Auth::user()->inCarts();
    }

    static public function countCarts() {
        return Cart::where('user_id','=',\Auth::id())
                ->where('settled_flag', '=', 0)->count();
    }
    
    static public function addCarts($goodId,$quantity,$goodPrice) {
        $sub_total = \Auth::user()->rank_num * $goodPrice * $quantity;
        \Auth::user()->inCarts()->attach($goodId,['quantity' => $quantity , 'sub_total' => $sub_total ,'settled_flag' => 0,]);
    }
    

    
    // static public function deleteCartsGoods(){
    //     self::myCarts()->wherePivot("settled_flag",'=',0)->update(['carts.settled_flag' => 1,]);
    // }
    
    public function deleteCartsGood($goodId){
        $userId = $this->id;
        $carts_id = $this->inCarts()->wherePivot("good_id",'=',$goodId)->wherePivot("settled_flag",'=',0)->detach();
        
    }
    
    public function clearCart(){
        $this->inCarts()->sync([]);
    }
    
    public function editCarts($goodId, $quantity){
        return $this->inCarts()->updateExistingPivot($goodId, ['quantity' => $quantity]);
    }
    
    public function feed_carts(){
          return (self::myCarts()->wherePivot('settled_flag','=',0)->get());
    }


    
    public function isGoodInCarts($good_Id){
         return $this->inCarts()->where('good_id', $good_Id)->wherePivot('settled_flag','=',0)->exists();
    } 
    

    static public function getDataMyCartGood($good_Id){
        return self::myCarts()->where('good_id',$good_Id);
    }
    
    static public function getDataMySettledGoods(){
        return self::myCarts()->wherePivot('settled_flag',1);
    }
    static public function getDataMySettledGood($good_Id){
        return self::getDataMyCartGood($good_Id)->wherePivot('settled_flag',1);
    }
    static public function getDataMyUnSettledGoods(){
        return self::myCarts()->wherePivot('settled_flag',0);
    }
    static public function getDataMyUnSettledGood($good_Id){
        return self::getDataMyCartGood($good_Id)->wherePivot('settled_flag',0);
    }
    
    static public function getGoodDetail($good_Id){
        $newtable = self::getDataMyCartGood($good_Id);
        return $newtable->wherePivot('settled_flag', '=', 0)->first();
    }
    
    // static public function changeQuantity($good_Id,$quantity,$good_price) {
    //     $sub_total = $good_price * \Auth::user()->rank_num * $quantity;
    //     self::getDataMyUnSettledGood($good_Id)->update(['carts.quantity' => $quantity , 'carts.sub_total' => $sub_total]);
    // }
    
    static public function changeQuantity($good_Id,$quantity,$good_price) {
        $sub_total = $good_price * \Auth::user()->rank_num * $quantity;
        self::myCarts()->wherePivot('settled_flag',0)->updateExistingPivot($good_Id, ['quantity' => $quantity,'sub_total'=>$sub_total]);
    }
    
        static public function deleteCartsGoods(){
        $settled_goods = self::myCarts()->wherePivot("settled_flag",'=',0);
        $settled_goods_id = $settled_goods->get(['good_id'])->toArray();
            foreach($settled_goods_id as $settled_good_id){
                $settled_goods->updateExistingPivot($settled_good_id['good_id'],['settled_flag' => 1]);
            }
    }
    
    // static public function changeQuantity($good_Id,$quantity,$good_price) {
    //     $sub_total = $good_price * \Auth::user()->rank_num * $quantity;
    //     $pivot_id = self::myCarts()->wherePivot('good_id',$good_Id)->wherePivot('settled_flag',0)->first()->pivot->id;
    //     self::myCarts()->updateExistingPivot($pivot_id, ['quantity' => $quantity,'sub_total'=>$sub_total]);;
    // }
    
    static public function detailUser(){
          $newtable = User::join('ranks', function ($join){
              $join->on('users.rank_num', '=', 'ranks.id');});
          return $newtable->where('users.id', '=', \Auth::id())->first();
    }
    
    static public function getHistory(){
            $historys = self::getDataMySettledGoods()
                                 ->orderBy('carts.created_at', 'desc')
                                 ->get();
            return $historys;
    }
    
    static public function storeSum(){
            $sum = self::getDataMySettledGoods()->sum('sub_total');
            User::where('id', '=', \Auth::id())->update(['total' => $sum ,]);
            return $sum;
    }
        
    static public function promoteRank($total){
            $promote_num = floor($total / Self::$judgment_value);
            $new_rank_num = (int)(\Auth::user()->first_rank_num - $promote_num);
            if($new_rank_num < 1){
                $new_rank_num = 1;
            }
            User::where('id','=',\Auth::id())->update(['rank_num' => $new_rank_num]);
    }

    static public function moneyOfCart(){
            return self::getDataMyUnSettledGoods()->sum('carts.sub_total');
        }
    
    
    
}
