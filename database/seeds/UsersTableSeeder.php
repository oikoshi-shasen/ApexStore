<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name' => 'Yudai',
            'email' => 'yudai_sasaki@fandmnet.com',
            'password' => Hash::make('00000000'),
            'rank_num' => '1',
            'role' => '1',
        ],
        [
            'name' => 'Menter',
            'email' => 'm@m.m',
            'password' => Hash::make('00000000'),
            'rank_num' => '2',
            'role' => '2',
        ],
        [
            'name' => 'h',
            'email' => 'h@h.h',
            'password' => Hash::make('00000000'),
            'rank_num' => '3',
            'role' => '9',
        ],
        [
            'name' => 'g',
            'email' => 'g@g.g',
            'password' => Hash::make('00000000'),
            'rank_num' => '5',
            'role' => '9',
        ],
        ]);
    }
}
