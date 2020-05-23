<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'man_user_id', 'woman_user_id'
    ]; 
}
