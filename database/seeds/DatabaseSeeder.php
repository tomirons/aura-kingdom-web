<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsTableSeeder::class);

        $this->call(ApplicationTableSeeder::class);

        $this->call(ArticlesTableSeeder::class);

        $this->call(RolesTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
    }
}
