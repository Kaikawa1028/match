<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function receive_user()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function send_user()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }
}
