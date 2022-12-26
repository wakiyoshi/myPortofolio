<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("categories")->insert([
			'id'           => 1 ,
			'name'  => 'ソファ' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 2 ,
			'name'  => 'チェア' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 3 ,
			'name'  => '生活雑貨' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 4 ,
			'name'  => '収納家具' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 5 ,
			'name'  => 'インテリア' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 6 ,
			'name'  => 'ベッド' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 7 ,
			'name'  => '時計' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 8 ,
			'name'  => 'キッチン' ,
        ]);
        DB::table("categories")->insert([
			'id'           => 9 ,
			'name'  => 'クッション' ,
        ]);


    }
}
