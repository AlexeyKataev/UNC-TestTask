<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $fillable = [
        'user_id',
        'action_id',
        'is_invite',
        'is_invite',
        'date_invite',
        'date_accept',
    ];
}
