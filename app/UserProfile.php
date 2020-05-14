<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $fillable = [
        'user_name', 'age', 'residence', 'job','img_url', 'text'
    ]; 

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
