<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'm_products';

    protected $fillable = [
        'name',
        'product_id',
        'purchase_price',
        'sale_price',
        'head_price',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'product_id' => 'string',
        'purchase_price' => 'integer',
        'sale_price' => 'integer',
        'head_price' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
