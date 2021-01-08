<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Model\Like;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','sex'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_profile()
    {
        return $this->hasOne('App\Model\UserProfile');
    }

    public function getLikeStatus(?User $user): ?string
    {
        $like = Like::where('from_user_id', $this->id)->where('to_user_id', $user->id)->first();

        if(!empty($like)) {
            if(empty($like->status)) {
                return "sended";
            }

            return $like->status;
        }

        $like = Like::where('from_user_id', $user->id)->where('to_user_id', $this->id)->first();

        if(!empty($like)) {
            if(empty($like->status)) {
                return "received";
            }

            return $like->status;
        }

        return "";
    }

    /**
     * いいねを
     */
    public function send_like_user()
    {   
        return $this->belongsToMany('App\User', 'likes', 'from_user_id', 'to_user_id');

    }

    public function receive_like_user()
    {
        return $this->belongsToMany('App\User', 'likes', 'to_user_id', 'from_user_id');

    }
}
