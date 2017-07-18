<?php namespace Fitatu\Models;


class CartItemRepository extends Repository
{
    /**
     * CartItemRepository constructor.
     * @param CartItem $cartItem
     */
    public function __construct(CartItem $cartItem)
    {
        $this->model = $cartItem;
    }

    /**
     * @param $cartId
     * @param $productId
     * @return mixed
     */
    public function findByCartIdAndProductId($cartId, $productId)
    {
        return $this->model
            ->where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();
    }
}