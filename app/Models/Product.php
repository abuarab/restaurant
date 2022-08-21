<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function productIngredients() {
        return $this->hasMany(ProductIngredient::class);
    }
}
