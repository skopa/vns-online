<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string|Carbon created_at
 */
class Log extends Model
{
    public const LogIn = 1;
    public const OnlinePing = 2;
    public const PageChanged = 3;
    public const LogInFail = 4;
    public const VnsError = 5;

    protected $fillable = ['event'];

    protected $events = [
        Log::LogIn => 'Log in on vns',
        Log::OnlinePing => 'Ping request sent',
        Log::PageChanged => 'Activity page changed',
        Log::LogInFail => 'Some gone wrong in login on vns',
        Log::VnsError => 'VNS did not sent response',
    ];

    public function setEventAttribute($value)
    {
        $this->attributes['event'] = $this->events[$value];
    }
}
