<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Good extends Model
{   
    
    protected $fillable = ['name', 'price', 'picture','explanation',];
    
    
    public function addGood($data)
    {
        $good = new Good();
        $good->create([
            'name' => $data->name,
            'price' => $data->price ,
            'picture' => $data->picture,
            'explanation' => $data->explanation,
                ]);
    }
    
    static function countGood(){
        return self::count();
    }
    
    
    static public function serchGoods($serch_word){
        return self::where('name', 'like', "%$serch_word%")->paginate(6);
    }
    
    public function beInCarts()
    {
        return $this->belongsToMany(User::class,'carts','gooid_id','user_id');
    }
    
    static public function sortByKey($key_name, $array) {
        foreach ($array as $key => $value) {
        $standard_key_array[$key] = $value[$key_name];
        }
    }
    
    static public function getRanking()
    {
        $goods = self::get();
        $ranking = [];
        foreach($goods as $good){
            $carts = Cart::where('settled_flag',1);
            $cart = $carts->where("good_id",$good->id)->get();
            if($cart->count() >= 1){
                $ranking[] = ['good'=>$good,'sum_quantity'=>$cart->sum('quantity')];
            }
            else{
                $ranking[] = ['good'=>$good,'sum_quantity'=>0] ;
            }
        }
        $SortKey = array_column($ranking, 'sum_quantity');
        array_multisort($SortKey, SORT_DESC, $ranking);
        return $ranking;
    }




    
    
    
    
    
    
    
}