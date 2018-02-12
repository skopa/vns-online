<?php

namespace App\Console\Commands;

use App\Jobs\PingOnlineJob;
use App\User;
use Illuminate\Console\Command;

class PingUserOnlineCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'online:user {user} {delay}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping selected user with defined delay';

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
        sleep($this->argument('delay'));
        echo 'Start pinging user ' . $this->argument('user') . '..' . PHP_EOL;
        dispatch(new PingOnlineJob(User::find($this->argument('user'))));
        return;
    }
}
