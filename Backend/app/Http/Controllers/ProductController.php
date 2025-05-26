<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->getAll();
    }

    public function show($id)
    {
        return $this->productService->findById($id);
    }

    public function store(ProductPostRequest $request)
    {
        return $this->productService->create($request->all());
    }

    public function update(ProductPostRequest $request, $id)
    {
        return $this->productService->update($request->all(), $id);
    }


    public function destroy($id)
    {
        return $this->productService->destroy($id);
    }

    public function deleteProducts(Request $request)
    {
        return $this->productService->deleteProducts($request->all());
    }

    public function getImage($id): JsonResponse
    {
        $data = $this->productService->getProductImage($id);
        return response()->json($data);
    }

    public function uploadImage(Request $request, $id): JsonResponse
    {
        $imgUrl = $this->productService->uploadProductImage($request, $id);
        return response()->json($imgUrl);
    }
}
