<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function ingredientMeasureId() {
        return $this->hasMany(Measure::class);
    }
}
