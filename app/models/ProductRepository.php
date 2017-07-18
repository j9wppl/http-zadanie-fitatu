<?php namespace Fitatu\Models;

class ProductRepository extends Repository
{
    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }
}