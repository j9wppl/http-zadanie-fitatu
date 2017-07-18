<?php namespace Fitatu\Models;

class ProductRepository
{
    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }
}