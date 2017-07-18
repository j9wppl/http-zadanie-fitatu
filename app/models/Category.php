<?php namespace Fitatu\Models;

use LaravelBook\Ardent\Ardent;

class Category extends Ardent
{
    protected $table = 'categories';

    public function __toString()
    {
        return $this->name;
    }
}