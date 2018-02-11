<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 * @property VisitTimeLine visitTimeLine
 * @property bool is_enabled
 */
class Link extends Model
{
    protected $fillable = ['link', 'comment', 'is_enabled', 'visit_time_line_id'];

    public function visitTimeLine()
    {
        return $this->belongsTo(VisitTimeLine::class);
    }

    public function getUserIdAttribute()
    {
        return $this->visitTimeLine->user_id;
    }
}
