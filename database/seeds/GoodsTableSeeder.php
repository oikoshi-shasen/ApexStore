<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
        ]
        ]);
    }
}
