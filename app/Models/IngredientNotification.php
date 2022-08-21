<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientNotification extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'ingredient_id', 'has_sent'];

    protected $table = 'ingredient_notification';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }
}
