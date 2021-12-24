<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public function user_creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_creator_id',
        'title',
        'description',
        'is_private',
        'date_start',
        'date_end',
    ];
}
