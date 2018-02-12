<?php

namespace App\Console\Commands;

use App\Jobs\PingOnlineJob;
use App\User;
use App\VisitTimeLine;
use Illuminate\Console\Command;

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
        $user = User::query()
            ->where('is_enabled', 1)
            ->whereHas('visitTimeLines', function ($q) {
                $q->whereRaw('DATE_ADD(UTC_TIME(), INTERVAL 2 HOUR) BETWEEN `from` AND `to`');
            })
            ->with('lastAction')
            ->get();

        $user->each(function (User $user){
            if (rand(1, 4) < (date('i') - $user->lastAction->created_at->minute)) {
                dispatch(new PingOnlineJob($user));
            }
        });
    }
}
