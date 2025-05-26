<?php

namespace App\Services;

interface ProductService
{
    public function getAll();

    public function findById($id);

    public function create($request);

    public function update($request, $id);

    public function destroy($id);

    public function deleteProducts($ids);


    public function getProductImage($id);

    public function uploadProductImage($request, $id);
}
