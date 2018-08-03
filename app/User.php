<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the quotes for the user.
     */
    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }

    /**
     * Check if the user is admin
     * @return boolean admin status
     */
    public function isAdmin()
    {        
        return $this->admin === 1;
    }
}
