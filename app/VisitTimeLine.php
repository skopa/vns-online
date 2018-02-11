<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int|Carbon from
 * @property int|Carbon to
 * @property int clicks_per_period
 * @property int user_id
 */
class VisitTimeLine extends Model
{
    protected $fillable = [
        'from', 'to', 'clicks_per_period'
    ];

    protected $hidden = [];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function getPeriodAttribute()
    {
        return $this->from . ' - ' . $this->to;
    }
}
