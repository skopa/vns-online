<?php

namespace App\Console\Commands;

use App\Jobs\PingOnlineJob;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;

class PingOnlineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'online:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping online status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::query()
            ->where('is_enabled', 1)
            ->whereHas('visitTimeLines', function ($q) {
                /** @var Builder $q */
                $q
                    ->whereRaw('`days` LIKE ' . date('N'))
                    ->whereRaw('DATE_ADD(UTC_TIME(), INTERVAL 2 HOUR) BETWEEN `from` AND `to`');
            })
            ->with('lastAction')
            ->get();

        /**
         * LifeHack!
         */
        $count = collect();

        $users->each(function (User $user) use ($count) {
            if ($user->lastAction == null || rand(1, 4) < $user->lastAction->created_at->diffInMinutes()) {
                dispatch(new PingOnlineJob($user));
                $count->push(1);
            }
        });

        echo $count->count() . '/' . $users->count() . PHP_EOL;

        return;
    }
}
