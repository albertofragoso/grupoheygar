<?php

namespace App;

use App\Product;
use App\Sucursal;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class); //1:1
    }

    public function responses()
    {
      return $this->hasMany(Response::class)->latest(); //1:N
    }

    public function sucursal()
    {
      return $this->belongsTo(Sucursal::class); //1:1
    }

}
