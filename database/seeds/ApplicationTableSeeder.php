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
        DB::table('applications')->insert([
            'key' => 'news',
            'position' => 1,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('applications')->insert([
            'key' => 'donate',
            'position' => 2,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('applications')->insert([
            'key' => 'vote',
            'position' => 3,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('applications')->insert([
            'key' => 'ranking',
            'position' => 4,
            'enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
