<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_number', 'product_id', 'user_id', 'quantity'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
