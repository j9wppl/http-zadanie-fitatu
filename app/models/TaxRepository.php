<?php namespace Fitatu\Models;


class TaxRepository extends Repository
{
    /**
     * TaxRepository constructor.
     * @param Tax $tax
     */
    public function __construct(Tax $tax)
    {
        $this->model = $tax;
    }
}