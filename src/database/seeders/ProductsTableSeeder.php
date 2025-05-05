<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'キウイ',
                'price' => 800,
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'kiwi.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟イチゴを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'strawberry.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'orange.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'watermelon.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'description' => '芳醇な香りととろけるような甘さが魅力のピーチ。おいしさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため。生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'peach.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'description' => '爽やかな香りと上品な甘みが特徴的なシャインマスカットは大人から子供まで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'muscat.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'pineapple.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'grapes.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'description' => '低カロリーでありながら栄養素満点のため、ダイエット中の方にもおすすめの商品です。1杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'banana.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'melon.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
