<?php namespace Fitatu\Models;

use LaravelBook\Ardent\Ardent;

class Tax extends Ardent
{
    protected $table = 'taxes';

    public function __toString()
    {
        return $this->name.': '.$this->rate.'%';
    }
}