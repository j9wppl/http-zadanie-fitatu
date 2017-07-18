<?php namespace Fitatu\Models;

class CategoryRepository extends Repository
{
    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}