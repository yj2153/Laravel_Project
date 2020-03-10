<?php

use Illuminate\Database\Seeder;

class NailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nails')->insert([
            'created' => date('YmdHis'),
            'type' => '1',
            'title_ko' => "원컬러(케어포함)",
            'title_jp' => 'ワンカーラ(ケア含む)',
            'price_ko' => '30000',
            'price_jp' => '3000',
            'useTime' => date('H:i:s',strtotime('01:00:00')),
        ]);

        DB::table('nails')->insert([
            'created' => date('YmdHis'),
            'type' => '2',
            'title_ko' => "원컬러(케어포함)",
            'title_jp' => 'ワンカーラ(ケア含む)',
            'price_ko' => '40000',
            'price_jp' => '4000',
            'useTime' => date('H:i:s',strtotime('01:00:00')),
        ]);

        DB::table('nails')->insert([
            'created' => date('YmdHis'),
            'type' => '3',
            'title_ko' => "케어",
            'title_jp' => 'ケアのみ',
            'price_ko' => '5000',
            'price_jp' => '500',
            'useTime' => date('H:i:s',strtotime('01:00:00')),
        ]);
    }
}
