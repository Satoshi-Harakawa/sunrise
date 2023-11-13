<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('categories')->insert([
        // 'category_name' => '北海道',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        // DB::table('categories')->insert([
        // 'category_name' => '東北',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        // DB::table('categories')->insert([
        // 'category_name' => '関東',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        // DB::table('categories')->insert([
        // 'category_name' => '中部',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        // DB::table('categories')->insert([
        // 'category_name' => '近畿',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        // DB::table('categories')->insert([
        // 'category_name' => '中国・四国',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        // DB::table('categories')->insert([
        // 'category_name' => '九州',
        // 'created_at' => new DateTime(),
        // 'updated_at' => new DateTime(),
        // ]);
        DB::table('categories')->insert([
            'category_name' => '南西諸島',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
