<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('goods')->insert([
        [
            'name'=> 'シールドセル',
            'price' => 500,
            'picture' => 'img/cell.jpg',
            'explanation' => ' (シールドを25ポイント回復する。使用時間3秒)',
        ],
        [
            'name'=> 'シールドバッテリー',
            'price' => 1500,
            'picture' => 'img/battery.jpg',
            'explanation' => ' (シールドを全回復する。使用時間5秒)',
        ],
        [
            'name'=> '注射器',
            'price' => 500,
            'picture' => 'img/Syringe.jpg',
            'explanation' => ' (体力を25ポイント回復する。使用時間5秒)',
        ],
        [
            'name'=> '医療キット',
            'price' => 1000,
            'picture' => 'img/Medi_kit.jpg',
            'explanation' => ' (体力を全回復する。使用時間8秒)',
        ],
        [
            'name'=> 'フェニックスキット',
            'price' => 1000,
            'picture' => 'img/Phoenix.jpg',
            'explanation' => ' (体力とシールドを全回復する。使用時間10秒)',
        ],
        [
            'name'=> 'アルティメット促進剤',
            'price' => 1000,
            'picture' => 'img/Ultimate.jpg',
            'explanation' => ' (アルティメットアビリティを20%回復する。)',
        ],
                [
            'name'=> 'オイルヒーター',
            'price' => 3000,
            'picture' => 'img/kaden_oil_heater.png',
            'explanation' => ' (中のオイルを温めて使う暖房器具。)',
        ],
        [
            'name'=> 'スマートウォッチ',
            'price' => 5000,
            'picture' => 'img/sports_katsudouryoukei.png',
            'explanation' => ' (運動量、消費カロリー、脈拍などを計測することができるトラッカー（スマートウォッチ）。)',
        ],
        [
            'name'=> '懐中電灯',
            'price' => 2000,
            'picture' => 'img/kaden_kaichu_dentou.png',
            'explanation' => ' (シンプルな懐中電灯（ハンディライト）。)',
        ],
        [
            'name'=> '置き時計',
            'price' => 1300,
            'picture' => 'img/kaden_digital_tokei.png',
            'explanation' => ' (デジタル数字が表示された置き時計のイラストです。)',
        ],
        [
            'name'=> 'テレビ',
            'price' => 8000,
            'picture' => 'img/display_monitor_tv.png',
            'explanation' => ' (風景が映し出されているテレビ（ディスプレイ）のイラストです。)',
        ],
        ]);
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
         DB::table('users')->insert([
        [
            'name' => 'Yudai',
            'first_rank_num' => '1',
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
            'first_rank_num' => '2',
            'role' => '2',
        ],
        [
            'name' => 'h',
            'email' => 'h@h.h',
            'password' => Hash::make('00000000'),
            'rank_num' => '3',
            'first_rank_num' => '3',
            'role' => '9',
        ],
        [
            'name' => 'g',
            'email' => 'g@g.g',
            'password' => Hash::make('00000000'),
            'rank_num' => '5',
            'first_rank_num' => '5',
            'role' => '9',
        ],
        ]);
    }
}
