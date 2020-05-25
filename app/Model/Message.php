<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function from_user()
    {
        return $this->belongsTo('App\User');
    }

    public function getLastText()
    {
        if(mb_strlen($this->text) >= 20) {
            return mb_substr($this->text, 0, 20)."...";
        }else {
            return $this->text;
        }
    }
}
