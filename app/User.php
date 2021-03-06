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
 * @property Collection|array|VisitTimeLine visitTimeLines
 * @property Collection|array|Link links
 * @property int available_clicks
 * @property-read mixed vns_credentials
 * @property Collection|array|Log logs
 * @property Log lastAction
 * @mixin Model
 * @method static find($id)
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

    protected $attributes = [
        'available_clicks' => 20
    ];

    public function setVnsEmailAttribute($value)
    {
        $this->attributes['vns_email'] = $value;
        $this->attributes['cookies_file'] = $value . '_' . str_random(16) . '.cookies';
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value;
        if (str_contains($value, '@lpnu.ua'))
            $this->vns_email = explode('@', $value)[0];
    }

    public function visitTimeLines()
    {
        return $this->hasMany(VisitTimeLine::class);
    }

    public function links()
    {
        return $this->hasManyThrough(Link::class, VisitTimeLine::class);
    }

    public function getVnsCredentialsAttribute()
    {
        return [
            'username' => $this->vns_email,
            'password' => $this->vns_password,
            'rememberusername' => 1,
        ];
    }

    public function logs()
    {
        return $this->hasMany(Log::class)->orderBy('id', 'desc');
    }

    public function lastAction()
    {
        return $this->hasOne(Log::class)->orderBy('id', 'desc');
    }
}
