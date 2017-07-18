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

    /**
     * @return array
     */
    public function allAssoc()
    {
        $result = [];
        foreach ($this->all() as $item) {
            $result[$item->id] = $item;
        }

        return $result;
    }
}
