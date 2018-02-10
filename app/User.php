<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string email
 * @property string vns_email
 * @property string vns_password
 * @property string cookies_file
 * @property bool is_enabled
 * @property Collection|VisitTimeLine visitTimeLines
 * @mixin Model
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'vns_email', 'vns_password', 'is_enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'cookies_file'
    ];

    public function setVnsEmailAttribute($value)
    {
        $this->attributes['vns_email'] = $value;
        $this->attributes['cookies_file'] = $value . '_' . str_random() . 'cookies';
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value;
        if (env('CHECK_DOMAIN', false)) $this->vns_email = $value;
    }

    public function visitTimeLines()
    {
        return $this->hasMany(VisitTimeLine::class);
    }

    public function links()
    {
        return $this->hasManyThrough(Link::class, VisitTimeLine::class);
    }
}
