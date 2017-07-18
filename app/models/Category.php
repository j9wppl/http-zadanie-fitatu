<?php namespace Fitatu\Models;

use LaravelBook\Ardent\Ardent;

class Category extends Ardent
{
    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}