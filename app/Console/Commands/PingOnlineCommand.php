<?php

namespace App\Console\Commands;

use App\Jobs\PingOnlineJob;
use App\User;
use Carbon\Carbon;
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
        $day = Carbon::now()->dayOfWeek;
        $users = User::query()
            ->where('is_enabled', 1)
            ->whereHas('visitTimeLines', function ($q) use ($day) {
                /** @var Builder $q */
                $q
                    ->whereRaw('`days` LIKE \'%' . $day . '%\'')
                    ->whereRaw('DATE_ADD(UTC_TIME(), INTERVAL 2 HOUR) BETWEEN `from` AND `to`');
            })
            ->with('lastAction')
            ->get();

        /**
         * LifeHack!
         */
        $count = collect();

        $users->each(function (User $user) use ($count) {
            if ($user->lastAction == null || rand(1, 3) < $user->lastAction->created_at->diffInMinutes()) {
                $command = base_path('artisan') . ' online:user ' . $user->id . ' ' . rand(3, 30);
                $log = storage_path('logs/cron.log');
                exec('nohup php -f ' . $command . ' >> ' . $log . ' 2>&1 &');
                $count->push(1);
            }
        });

        echo
            'Day: ' . $day .
            ' Will be updated/All active: ' . $count->count() . '/' . $users->count() .
            PHP_EOL;

        return;
    }
}
