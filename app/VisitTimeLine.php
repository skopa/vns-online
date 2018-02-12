<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property int|Carbon from
 * @property int|Carbon to
 * @property int clicks_per_period
 * @property int user_id
 * @property Collection days
 * @property string short_days
 */
class VisitTimeLine extends Model
{
    protected $fillable = [
        'from', 'to', 'clicks_per_period', 'days'
    ];

    protected $hidden = [];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function getPeriodAttribute()
    {
        return $this->from . ' - ' . $this->to . ': ' .$this->short_days;
    }

    public function getDaysAttribute()
    {
        return collect(str_split($this->attributes['days']));
    }

    public function setDaysAttribute($value)
    {
        $this->attributes['days'] = implode('', $value);
    }

    public function getShortDaysAttribute()
    {
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        return $this->days->filter(function ($item){
            return intval($item)>0;
        })->map(function ($item) use ($days){
            return $days[intval($item)-1];
        })->implode(', ');
    }
}
