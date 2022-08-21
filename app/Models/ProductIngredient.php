<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIngredient extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'ingredient_id', 'ingredient_measure_id', 'ingredient_value'];

    protected $table = 'product_ingredient';

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }

    public function ingredientMeasure() {
        return $this->belongsTo(Measure::class);
    }
}
