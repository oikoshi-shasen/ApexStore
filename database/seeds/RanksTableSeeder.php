<?php

use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
        [
            'id' => 1,
            'rank_num'=> 1,
            'rank' => 'predator'
        ],
        [
            'id' => 2,
            'rank_num'=> 2,
            'rank' => 'master'
        ],
        [
            'id' => 3,
            'rank_num'=> 3,
            'rank' => 'diamond'
        ],
        [
            'id' => 4,
            'rank_num'=> 4,
            'rank' => 'pratinam'
        ],
        [
            'id' => 5,
            'rank_num'=> 5,
            'rank' => 'gold'
        ],
        [
            'id' => 6,
            'rank_num'=> 6,
            'rank' => 'silver'
        ],
        [
            'id' => 7,
            'rank_num'=> 7,
            'rank' => 'bronze'
        ],
        ]);
        
 
    }
    
    
    
    
}
