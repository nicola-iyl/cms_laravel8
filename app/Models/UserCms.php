<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

/**
 * @property mixed role_id
 * @property mixed|null shop_id
 * @property mixed name
 * @property mixed email
 * @property mixed|string password
 */
class UserCms extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['role_id','shop_id','name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    //facciamo l'override del metodo già implementato per fare un'email custom per il recupero password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function role()
    {
        return $this->belongsTo(RoleCms::class);
    }

    /*public function shop()
    {
        return $this->belongsTo('App\Model\Shop');
    }

    public function clear_pwd()
    {
        return $this->hasOne('App\Model\Cms\ClearcmsPassword');
    }*/
}
