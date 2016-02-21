<?php

namespace App\Console;

use App\Family;
use App\Player;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $players = DB::connection('game')->table('player_characters')->get();
            foreach ($players as $player)
            {
                if (!Player::where('id', $player->id)->exists())
                {
                    $player_info = [
                        'id' => $player->id,
                        'name' => $player->given_name,
                        'level' => $player->level,
                        'class' => 0,
                        'gold' => $player->gold,
                        'family_name' => ($player->family_id) ? DB::connection('game')->table('family')->where('id', $player->family_id)->first()->name : '-'
                    ];

                    Player::create($player_info);
                }
            }
        })->everyTenMinutes();

        $schedule->call(function () {
            $families = DB::connection('game')->table('family')->get();
            foreach ($families as $family)
            {
                if (!Family::where('id', $family->id)->exists())
                {
                    $gold = 0;
                    foreach ( DB::connection( 'game' )->table( 'player_characters' )->where( 'family_id', $family->id )->get() as $player )
                    {
                        $gold += $player->gold;
                    }

                    $family_info = [
                        'id' => $family->id,
                        'name' => $family->name,
                        'level' => $family->lv,
                        'gold' => $gold,
                        'members' => DB::connection( 'game' )->table( 'player_characters' )->where( 'family_id', $family->id )->count(),
                        'leader' => DB::connection( 'game' )->table( 'player_characters' )->where( 'id', $family->leader_id )->first()->given_name
                    ];

                    Family::create($family_info);
                }
            }
        })->everyTenMinutes();
    }
}
