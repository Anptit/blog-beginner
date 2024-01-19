<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract protected function model();

    public function setModel()
    {
        $this->model = app()->make($this->model());
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function paginate()
    {
        return $this->getAll()->paginate();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->model->withTrashed()->find($id);

        if ($result) {
            $result->update($attributes);
        }

        return $result;
    }

    public function delete($id) 
    {
        $result = $this->model->withTrashed()->find($id);

        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}