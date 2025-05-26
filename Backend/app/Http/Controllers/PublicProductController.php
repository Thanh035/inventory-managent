<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddProductToCollectionResource;
use App\Repositories\ProductRepo;

class PublicProductController extends Controller
{
    protected ProductRepo $productRepo;

    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        return AddProductToCollectionResource::collection($products);
    }
}
