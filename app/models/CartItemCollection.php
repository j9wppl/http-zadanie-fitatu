<?php namespace Fitatu\Models;

use Illuminate\Database\Eloquent\Collection;

class CartItemCollection extends Collection
{
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }

    /**
     * @return int
     */
    public function totalGross()
    {
        $total = 0;

        foreach ($this->items as $cartItem) {
            $total += $cartItem->value_gross;
        }

        return $total;
    }
}
