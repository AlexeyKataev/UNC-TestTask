<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginSource extends Model
{
    public function user_creator()
    {
        $this->hasOne('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_creator',
        'tms',
        'source',
    ];
}
