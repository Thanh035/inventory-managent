<?php

namespace App\Repositories\Impl;


use App\Repositories\Repository;
use Exception;

abstract class EloquentRepository implements Repository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get Model
     * @return string
     */
    abstract public function getModel();

    /**
     * set Model
     */
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
//        if ($pagination) {
//            $perPage = $pagination->input('per_page', 10); // Lấy tham số 'per_page' từ request hoặc mặc định là 10
//            $result = $this->model->paginate($perPage);
//        } else {
        $result = $this->model->all();
//        }

        return $result;
    }

    public function findById($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function create($data)
    {
        try {
            $object = $this->model->create($data);
        } catch (Exception $e) {
            return null;
        }
        return $object;
    }

    public function update($data, $object)
    {
        $object->update($data);
        return $object;
    }

    public function destroy($object)
    {
        $object->delete();
    }
}
