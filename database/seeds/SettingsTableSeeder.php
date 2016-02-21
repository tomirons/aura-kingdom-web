<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( !DB::table('settings')->where('setting_key', 'server_name' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'server_name',
                'setting_value' => serialize('Aura Kingdom')
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paypal_per' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paypal_per',
                'setting_value' => serialize(2)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paypal_min' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paypal_min',
                'setting_value' => serialize(5)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paypal_double' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paypal_double',
                'setting_value' => serialize(FALSE)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paypal_client_id' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paypal_client_id',
                'setting_value' => serialize(NULL)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paypal_secret' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paypal_secret',
                'setting_value' => serialize(NULL)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paypal_currency' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paypal_currency',
                'setting_value' => serialize('USD')
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paymentwall_double' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paymentwall_double',
                'setting_value' => serialize(FALSE)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paymentwall_link' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paymentwall_link',
                'setting_value' => serialize(NULL)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paymentwall_app_key' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paymentwall_app_key',
                'setting_value' => serialize(NULL)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'paymentwall_key' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'paymentwall_key',
                'setting_value' => serialize(NULL)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'ranking_ignore_characters' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'ranking_ignore_characters',
                'setting_value' => serialize(NULL)
            ]);
        }

        if ( !DB::table('settings')->where('setting_key', 'ranking_ignore_families' )->exists() )
        {
            DB::table('settings')->insert([
                'setting_key' => 'ranking_ignore_families',
                'setting_value' => serialize(NULL)
            ]);
        }
    }
}
