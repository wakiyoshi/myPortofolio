<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'カウチソファー(GY)',
            'category_id' => 1,
            'information' => '頑丈な素材でできた化学繊維を使用、お部屋の雰囲気に溶け込みやすいグレーのソファー。',
            'price' => 69800,
            'quantity' =>  1,
            'material' => 'ポリエステル',
            'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/tQbJ5wTZdhJnPygS0d9633vPnbKgyM4f1ZUOoXS4.png',
            'image2' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/uLzWoa0Nazz4iNfyT26uCeDoI9VxWz3jtU8uFIuB.png',
            'image3' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/FmwKAjQz135gvwnOpGPWjcfo0IaQ4ir3ZPL66Mwa.png',
            'image4' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/dDtBmu2Q7iWfpvIWQyHMve6qDY5CTpPjCiBvKM3V.png',
            'image5' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/iYytKAPQtHeSYbO2Xc4z4CT6hmyWazhOr5A3pLBO.png',
            'image6' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/4C6kzuwYllCrOzNwFYVYhwNj81MhjNKFgSW9pDeN.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'チェア(WH)',
            'category_id' => 2,
            'information' => '背もたれに使われている材木は、職人の技によって背中にフィットするような曲線になっていて、座りごごち抜群です。カラーはオーソドックスなホワイト',
            'price' => 19800,
            'quantity' =>  2,
            'material' => '材木（樫の木）・ポリエステル',
            'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/ko195dXQK3tToLe8GM1CXhy9U8mBW3tVyTeVyWDK.png',
            'image2' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/zbav2UKZNCgkrOVHe4w9v1AGkQG6uNLfnHRcMwVh.png',
            'image3' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/463PpUG0NBDwKV8jKtNKo5spDCaE3POwE7i05lp2.jpg',
            'image4' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/miS1R0gzRRyIeTWF3cxUiLTANThk5dz07qs9b7IJ.jpg',
            'image5' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/4XrMcsQpZfRgh1xARbEUt49T9oxSFlmEQ3HXFXsi.jpg',
            'image6' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/3ZYmSOhDUGFSIBzHhY6XBC3kZ6BslCXUd7LMlJG1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('products')->insert([
            'name' => '壁掛けフォトフレーム',
            'category_id' => 5,
            'information' => 'フレームに3枚の写真を入れることができます。下部のポケットには観用植物などのインテリアをおいてアレンジ可能です。',
            'price' => 3520,
            'quantity' =>  3,
            'material' => 'ステンレス',
            'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/tQbJ5wTZdhJnPygS0d9633vPnbKgyM4f1ZUOoXS4.png',
            'image2' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/8g9NxNFvgpKGA2L67AFYXHOmimwIT8JDOaZDwe4P.png',
            'image3' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/7h8iOsmn3BLFlzeFO2fENBxEibb5AJZFHP5uH7cG.png',
            'image4' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/G7DHG9L7ZJB06fK7ln52DzxzjTrZrJymQuxfv4UQ.png',
            'image5' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/K478Qy0HKeo2WhflofNPMxFnfLaS1uD941LabiGv.png',
            'image6' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/HlmBqeNoNEjHPoR1esBXWn97zc3reKlIikfD5pdC.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'name' => 'クロスラック',
                'category_id' => 4,
                'information' => 'ここに商品説明が入ります。ここに商品説明が入ります。ここに商品説明が入ります。',
                'price' => 49800,
                'quantity' =>  4,
                'material' => 'ステンレス',
                'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/wmRifJR7yXz0ZR3HXWH7LUbKMSIbPQCBsZWqdbLA.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'name' => 'バスケット',
                'category_id' => 3,
                'information' => 'ここに商品説明が入ります。ここに商品説明が入ります。ここに商品説明が入ります。',
                'price' => 550,
                'quantity' =>  4,
                'material' => 'アルミニウム',
                'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/9kWHPpnjG0vtBVyFLDD2xPJOUiuMftRFDo76KkBA.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'name' => '組み立て式ベッド',
                'category_id' => 6,
                'information' => 'ここに商品説明が入ります。ここに商品説明が入ります。ここに商品説明が入ります。',
                'price' => 79800,
                'quantity' =>  8,
                'material' => '木材（杉の木）',
                'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/IdvP1X33k09Wntv05Y1FB1CsEOfhhjrHGITkJSGJ.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'name' => '掛け時計（WH）',
                'category_id' => 7,
                'information' => 'ここに商品説明が入ります。ここに商品説明が入ります。ここに商品説明が入ります。',
                'price' => 3900,
                'quantity' =>  4,
                'material' => 'ステンレス',
                'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/UqjtHHwYr5Sv3VP9zSuky2e4bcQtLmXs9KXeaaYO.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'name' => 'ハンドミキサー',
                'category_id' => 8,
                'information' => 'ここに商品説明が入ります。ここに商品説明が入ります。ここに商品説明が入ります。',
                'price' =>  1980,
                'quantity' =>  4,
                'material' => 'ステンレス',
                'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/aAFqvUGC323FUdpkqcFeDcswaraEohZdBab4kmT8.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'name' => 'クッション',
                'category_id' => 9,
                'information' => 'ここに商品説明が入ります。ここに商品説明が入ります。ここに商品説明が入ります。',
                'price' => 4980,
                'quantity' =>  4,
                'material' => 'ステンレス',
                'image1' =>  'https://myinterigentbucket.s3.ap-northeast-1.amazonaws.com/myinterigentbucket/nUIEwNo6r0dlLypPN1ibpayxF2BKp49e3hIzrRh8.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // \App\Models\Product::factory(100)->create();
    }
}
