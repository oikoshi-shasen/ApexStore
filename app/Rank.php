<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Good;
use App\Cart;


class Rank extends Model
{
        protected $fillable = ['rank_num','rank'];
        
        
        
        
        
    public function users()
    {
        return $this->hasMany(User::class);
    }
        
        
        
        
        
        
        
        
        
        
        
}
