<?php namespace Fitatu\Models;

use LaravelBook\Ardent\Ardent;

class Cart extends Ardent
{
    protected $table = 'carts';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}