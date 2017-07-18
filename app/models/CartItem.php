<?php namespace Fitatu\Models;

use LaravelBook\Ardent\Ardent;

class CartItem extends Ardent
{
    protected $table = 'cart_items';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}