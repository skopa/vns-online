<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChangeCourseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'online:course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change visited course';

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
        //
    }
}
