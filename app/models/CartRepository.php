<?php namespace Fitatu\Models;


class CartRepository extends Repository
{
    /**
     * CartRepository constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }
}