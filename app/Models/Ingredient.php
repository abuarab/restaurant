<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'original_value', 'stock_value', 'measure_id'];

    protected $table = 'Ingredients';

    public function productIngredient() {
        return $this->hasMany(ProductIngredient::class);
    }

    public function ingredientNotification() {
        return $this->hasMany(IngredientNotification::class);
    }
}
