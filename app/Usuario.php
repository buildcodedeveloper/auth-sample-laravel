<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario  extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'name','username','email', 'senha','active'
    ];

    protected $hidden = [
        'senha', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->senha;
    }

}