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
        'name', 'email', 'password','rank_num',
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
    
    
    
    public function inCarts()
    {
        return $this->belongsToMany(Good::class,'carts','user_id','good_id')
            ->withPivot(['quantity']);
    }
    
      
        public function countCarts() 
    {
        $user_Id = $this->id; 
        return Cart::where('user_id', '=', $user_Id)->count();
    }
    
    
    public function addCarts($goodId,$quantity) 
    {
        $userId = $this->id;
        $this->inCarts()->attach($goodId,['quantity' => $quantity]);
    }
    
    
    
    public function deleteCartsGoods($goodIds) 
    {
        $userId = $this->id;
        foreach($goodIds as $goodId){
            $this->inCarts()->detach($goodId);
        }
    }
    
    public function deleteCartsGood($goodId) 
    {
        $userId = $this->id;
        $this->inCarts()->detach($goodId);
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
          return ($newtable->where('user_id', '=', $user_Id)->get());
    }
    
        // public function feed_carts()
        // {
        //   $goods_Id = $this->inCarts()->pluck('carts.good_id')->toArray();
        //   $user_Id = $this->id; 
        //   $newtable = Good::leftJoin('carts', function ($join){
        //       $join->on('goods.id', '=', 'carts.good_id');});
        //   return ($newtable->whereIn('good_id',$goods_Id)->where('user_id', '=', $user_Id)->get());
            
        // }
    
    
    
        public function feedGoodIds()
    {
          return ($this->inCarts()->pluck('carts.good_id')->toArray());
    }
    
    
    
    public function isGoodInCarts($good_Id){
         return $this->inCarts()->where('good_id', $good_Id)->exists();
    } 
    
    
    
    
    
    public function getGoodDetail($good_Id){
        $user_Id = $this->id; 
        $newtable = Good::leftJoin('carts', function ($join){
        $join->on('goods.id', '=', 'carts.good_id');});
        return ($newtable->where('good_id',$good_Id)->where('user_id', '=', $user_Id)->get());
    }
    
    
        public function changeQuantity($good_Id,$quantity) 
    {
        $user_Id = $this->id; 
        $newtable = Good::leftJoin('carts', function ($join){
        $join->on('goods.id', '=', 'carts.good_id');});
        $newtable->where('good_id',$good_Id)->where('user_id', '=', $user_Id)->update(['quantity' => $quantity]);
    }
    
  
    
    
        public function rank()
    {
          $user_Id = $this->id; 
          $newtable = User::join('ranks', function ($join){
              $join->on('users.rank_num', '=', 'ranks.id');});
          return ($newtable->where('users.id', '=', $user_Id)->get()[0]);
    }
    
    
    
    
}
