<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function project_updates()
    {
        return $this->hasMany('App\ProjectUpdate');
    }

    public function activities()
    {
        return $this->hasMany('App\UserActivity');
    }

    public function moodboards()
    {
        return $this->hasMany('App\Moodboard');
    }

    public function moodboard_posts()
    {
        return $this->hasMany('App\MoodboardPost');
    }

}
