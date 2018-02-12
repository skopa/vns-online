<?php

namespace App\Jobs;

use App\Log;
use App\User;
use Curl\Curl;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PingOnlineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use CurlPresetsTrait, Urls;


    protected $user;


    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \ErrorException
     */
    public function handle()
    {
        $curl = new Curl();
        $this->preset($curl);

        $curl->setCookieFile(storage_path($this->user->cookies_file));
        $curl->setCookieJar(storage_path($this->user->cookies_file));

        $curl->get($this->pingUrl);

        //dd($curl->response);

        if (is_string($curl->response) && !str_contains($curl->response, 'time')) {
            $curl->post($this->loginUrl, $this->user->vns_credentials, true);
            if (str_contains($curl->getInfo()['url'], '/my')) {
                $this->log(Log::LogIn);

                dispatch(new ChangeCourseJob($this->user));

                $curl->get($this->pingUrl);
                if (is_string($curl->response) && str_contains($curl->response, 'time')) {
                    $this->log(Log::OnlinePing);
                }
            } else {
                $this->log(Log::LogInFail);
            }
        } else if (is_string($curl->response) && str_contains($curl->response, 'time')) {
            $this->log(Log::OnlinePing);
        } else {
            $this->log(Log::VnsError);
        }
    }

    private function log($ev)
    {
        $this->user->logs()->create([
            'event' => $ev
        ]);
    }
}
