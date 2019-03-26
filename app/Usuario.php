<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario  extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $password = 'senha';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','email', 'senha','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->senha;
    }

   


    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['senha'] = bcrypt($value);
    // }
    //
}