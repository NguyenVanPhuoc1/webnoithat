<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\CrudOperationsInterface;

abstract class AbstractCrud implements CrudOperationsInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Chuẩn bị dữ liệu (ví dụ: xử lý thêm các trường mặc định)
    public function create(array $data)
    {
        return $data;
    }

    // Thêm dữ liệu vào database
    public function add(array $data)
    {
        return $this->model->create($data);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $record = $this->getById($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->getById($id);
        return $record->delete();
    }
}
?>