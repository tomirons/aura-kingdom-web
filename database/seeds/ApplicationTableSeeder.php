<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apps')->insert([
            'key' => 'news',
            'position' => 1,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /*DB::table('apps')->insert([
            'key' => 'shop',
            'position' => 2,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);*/

        DB::table('apps')->insert([
            'key' => 'donate',
            'position' => 3,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('apps')->insert([
            'key' => 'vote',
            'position' => 4,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('apps')->insert([
            'key' => 'services',
            'position' => 5,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('apps')->insert([
            'key' => 'ranking',
            'position' => 6,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
