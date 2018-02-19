<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password', 'image',
    ];*/
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
      return $this->hasMany(Product::class)->orderBy('created_at', 'desc'); //1:N
    }

    public function socialProfiles()
    {
      return $this->hasMany(SocialProfile::class); //N:N
    }

    public function scopeAdmins($query)
    {
        return $query->where('roll', 1);
    }

    public function sucursales()
    {
      return $this->hasMany(Sucursal::class)->orderBy('created_at', 'desc'); //1:N
    }

    public function group()
    {
      return $this->belongsTo(Group::class); //1:1
    }
}
