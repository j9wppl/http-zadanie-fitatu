<?php namespace Fitatu\Models;

class Repository
{
    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @param array $attributes
     * @param bool $exists
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function newInstance(array $attributes = [], $exists = false)
    {
        return $this->model->newInstance($attributes, $exists);
    }
}