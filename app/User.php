<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User;
use App\Good;
use App\Cart;
use App\Rank;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rank_num','total','created_at', 'first_rank_num'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
     
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    static public $judgment_value = 500000;
    
    public function inCarts()
    {
        return $this->belongsToMany(Good::class,'carts','user_id','good_id')
            ->withPivot(['quantity','sub_total','settled_flag']);
    }
    
      
        public function countCarts() 
    {
        $user_Id = $this->id; 
        return Cart::where('user_id', '=', $user_Id)->where('settled_flag', '=', 0)->count();
    }
    
    
    public function addCarts($goodId,$quantity,$goodPrice) 
    {
        $rank_num = $this->rank_num;
        $sub_total = $rank_num * $goodPrice * $quantity;
        $this->inCarts()->attach($goodId,['quantity' => $quantity , 'sub_total' => $sub_total ,'settled_flag' => 0,]);
    }
    
    
    
    public function deleteCartsGoods($goodIds) 
    {
        $userId = $this->id;
        $this->inCarts()->wherePivot("settled_flag",'=',0)->update(["carts.settled_flag" => 1,]);
     }
    
    public function deleteCartsGood($goodId) 
    {
        $userId = $this->id;
        // dd($this->inCarts()->where('goods.id','=',$goodId)->get());
        // dd($this->inCarts());
        //dd($goodId);
        $carts_id = $this->inCarts()->wherePivot("good_id",'=',$goodId)->wherePivot("settled_flag",'=',0)->detach();
        
    }
    
    public function clearCart()
    {
        $this->inCarts()->sync([]);
    }
    
    public function editCarts($goodId, $quantity)
    {
        return $this->inCarts()->updateExistingPivot($goodId, ['quantity' => $quantity]);
    }
    
    
    
    // public function feed_carts()
    // {
    //       $goods_Id = $this->inCarts()->pluck('carts.good_id')->toArray();
    //       $goods_quantity = $this->inCarts()->pluck('carts.quantity')->toArray();
    //       $goods = Good::whereIn('id',$goods_Id)->get();
    // }
    //試作機1
    
        public function feed_carts()
    {
          $user_Id = $this->id; 
          $newtable = Good::join('carts', function ($join){
              $join->on('goods.id', '=', 'carts.good_id');});
          return ($this->inCarts()->where('settled_flag','=',0)->get());
    }

    
    
        public function feedGoodIds()
    {
          return ($this->inCarts()->where('settled_flag','=',0)->pluck('carts.good_id')->toArray());
    }
    
    
    
    public function isGoodInCarts($good_Id){
         return $this->inCarts()->where('good_id', $good_Id)->where('settled_flag','=',0)->exists();
    } 
    
    
    
    
    
    public function getGoodDetail($good_Id){
        $user_Id = $this->id; 
        $newtable = Good::Join('carts', function ($join){
        $join->on('goods.id', '=', 'carts.good_id');});
        return (
            $newtable
            ->where('good_id',$good_Id)
            ->where('user_id', '=', $user_Id)
            ->where('settled_flag', '=', 0)
            ->get()
                );
    }
    
    
        public function changeQuantity($good_Id,$quantity,$good_price) 
    {
        $user_Id = $this->id; 
        $sub_total = $good_price * $this->rank_num * $quantity;
        $newtable = Good::leftJoin('carts', function ($join){
        $join->on("goods.id", '=', "carts.good_id");});
        $newtable->where("good_id",$good_Id)
        ->where("user_id", '=', $user_Id)
        ->where("settled_flag", '=' ,0)
        ->update(["quantity" => $quantity , "sub_total" => $sub_total]);
    }
    
  
    
    
        public function rank()
    {
          $user_Id = $this->id; 
          $newtable = User::join('ranks', function ($join){
              $join->on('users.rank_num', '=', 'ranks.id');});
          return ($newtable->where('users.id', '=', $user_Id)->first());
    }
    
    
        public function getHistory(){
            $newtable = Good::leftJoin('carts', function ($join){
            $join->on('goods.id', '=', 'carts.good_id');});
            $historys = $newtable->where('user_id', '=', $this->id)
                                 ->where('settled_flag', '=' ,1)
                                 ->orderBy('carts.created_at', 'desc')
                                 ->get();
            return ($historys);
    }
    
        public function storeSum(){
            $newtable = Good::leftJoin('carts', function ($join){
                $join->on('goods.id', '=', 'carts.good_id');});
                $sum = $newtable->where('user_id', '=', $this->id)
                                 ->where('settled_flag', '=' ,1)
                                 ->sum('sub_total');
            User::where('id', '=', $this->id)->update(['total' => $sum ,]);
            return $sum;
        }
        
        public function promoteRank($total){
            $rank_num = $this->rank_num;
            $promote_num = floor($total / Self::$judgment_value);
            $new_rank_num = (int)($this->first_rank_num - $promote_num);
            if($new_rank_num < 1){
                $new_rank_num = 1;
            }
            User::where('id','=',$this->id)->update(['rank_num' => $new_rank_num]);
        }
    
    
        public function moneyOfCart(){
            $newtable = Good::leftJoin('carts', function ($join){
                $join->on('goods.id', '=', 'carts.good_id');});
            $money_of_cart = $newtable->where('user_id', '=', $this->id)
                                 ->where('settled_flag', '=' ,0)
                                 ->sum('sub_total');
            return $money_of_cart;
        }
    
    
    
    
}
