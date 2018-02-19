<?php

namespace App;

use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $guarded = [];
    public $table = "sucursales";

    public function user()
    {
      return $this->belongsTo(User::class); //1:1
    }

    public function product()
    {
      return $this->hasMany(Product::class); //1:N
    }

    public static function sucursales($id) {
      return Sucursal::where('user_id', $id)->get();
    }
}
