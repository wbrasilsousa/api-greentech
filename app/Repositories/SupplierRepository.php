<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository implements SupplierRepositoryInterface
{

    protected $model;
    
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): ?Supplier
    {
        return $this->model->with('products')->find($id);
    }

    public function create(array $data): Supplier
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $supplier = $this->find($id);
        if (!$supplier) {
            return false;
        }
        return $supplier->update($data);
    }

    public function delete(int $id): bool
    {
        $supplier = $this->find($id);
        if (!$supplier) {
            return false;
        }
        return $supplier->delete();
    }

}