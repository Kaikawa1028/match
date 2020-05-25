<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'man_user_id', 'woman_user_id'
    ]; 

    public function man_user()
    {
        return $this->belongsTo('App\User', 'man_user_id');
    }

    public function woman_user()
    {
        return $this->belongsTo('App\User', 'woman_user_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Model\Message');
    }
    
}
