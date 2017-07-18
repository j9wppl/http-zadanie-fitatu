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

    /**
     * @return int
     */
    public function getValueGrossAttribute()
    {
        return $this->price_gross * $this->quantity;
    }

    /**
     * @param array $models
     * @return static
     */
    public function newCollection(array $models = array())
    {
        return CartItemCollection::make($models);
    }
}