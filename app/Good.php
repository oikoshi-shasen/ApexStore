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
    
    
    
    
    
    
    
    public function beInCarts()
    {
        return $this->belongsToMany(User::class,'carts','gooid_id','user_id');
    }
    
    public function allCarts()
    {
    }
    
    
    
    
    
    
    
    
}
