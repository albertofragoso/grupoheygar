<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongTo(User::class);
    }
}
