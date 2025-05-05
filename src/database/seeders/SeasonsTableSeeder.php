<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            ['name' => 'Spring'],
            ['name' => 'Summer'],
            ['name' => 'Fall'],
            ['name' => 'Winter'],
        ];

        DB::table('seasons')->insert($param);
    }
    //シーズンごとにnameを定義した配列を作り、それを一度にseasonテーブルに挿入する形
}
