<?php namespace Fitatu\Models;

use LaravelBook\Ardent\Ardent;

class Product extends Ardent
{
    protected $table = 'products';

    public function __toString()
    {
        return $this->name;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }

}