<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'content' => '1.商品のお届けについて',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'content' => '2.商品の交換について',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'content' => '3.商品トラブル',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'content' => '4.ショップへのお問い合わせ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);
        $param = [
            'content' => '5.その他',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('categories')->insert($param);

    }
}
