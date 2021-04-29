<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleCms extends Model
{
    protected $fillable = ['name','description'];

    public function user()
    {
        return $this->hasOne(UserCms::class);
    }

    public function users()
    {
        return $this->hasMany(UserCms::class);
    }
}
