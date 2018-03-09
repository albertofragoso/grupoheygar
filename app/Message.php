<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class); //1:1
    }

    public function message()
    {
      return $this->belongsTo(Product::class); //1:1
    }
}
