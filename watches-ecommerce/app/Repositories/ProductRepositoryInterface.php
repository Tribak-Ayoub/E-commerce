<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all($paginate = 10);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function restore($id);
}
