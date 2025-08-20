<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }
}
