<?php

namespace App\Services\Impl;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Resources\AddProductToCollectionResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductViewResource;
use App\Repositories\ImageRepo;
use App\Repositories\ProductRepo;
use App\Repositories\UsingImageRepo;
use App\Repositories\UsingTypeRepo;
use App\Services\ProductService;
use App\Services\StorageService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;


class ProductServiceImpl implements ProductService
{
    protected ProductRepo $productRepo;
    protected StorageService $storageService;
    protected UsingTypeRepo $usingTypeRepo;
    protected ImageRepo $imageRepo;
    protected UsingImageRepo $usingImageRepo;

    public function __construct(ProductRepo    $productRepo,
                                StorageService $storageService,
                                UsingTypeRepo  $usingTypeRepo,
                                ImageRepo      $imageRepo,
                                UsingImageRepo $usingImageRepo)
    {
        $this->productRepo = $productRepo;
        $this->storageService = $storageService;
        $this->usingTypeRepo = $usingTypeRepo;
        $this->imageRepo = $imageRepo;
        $this->usingImageRepo = $usingImageRepo;
    }

    public function getAll()
    {
        $products = $this->productRepo->getAll();
        return ProductResource::collection($products);

//        return ProductResource::collection($products->map(function ($product) {
//            return array_merge($product->toArray(), [
//                'image' => $this->getImage($product)
//            ]);
//        }));

    }

    /**
     * @throws ResourceNotFoundException
     */
    public function findById($id)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException("Product with id[{$id}] not found");
        }

        return new ProductViewResource($product);
    }

    public function create($request)
    {
        $product = $this->productRepo->create($request);
        return new ProductResource($product);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function update($request, $id)
    {
        $oldProduct = $this->productRepo->findById($id);
        if (!$oldProduct) {
            throw new ResourceNotFoundException("Product with id[{$id}] not found");
        }
        $updateProduct = $this->productRepo->update($request, $oldProduct);
        return new ProductResource($updateProduct);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function destroy($id)
    {
        $product = $this->checkIfProduct($id);
        $this->productRepo->destroy($product);
    }

    public function deleteProducts($ids)
    {
        foreach ($ids as $id) {
            $this->destroy($id);
        }
    }


    private function checkIfProduct($id)
    {
        $product = $this->productRepo->findById($id);
        if (!$product) {
            throw new ResourceNotFoundException("Product with id[{$id}] not found");
        }
        return $product;
    }

    public function getProductImage($id)
    {
        $product = $this->productRepo->findById($id);
        if (!$product) {
            throw new ResourceNotFoundException(sprintf("Product with id [%s] not found", $id));
        }
        $usingTypeId = $this->usingTypeRepo->findByObj('products')->id;

        $productImageIds = $product->usingImage()
            ->where('type_id', $usingTypeId)
            ->with('image') // Lấy luôn thông tin ảnh từ bảng `images`
            ->get()
            ->pluck('image.name');

        if (Str::of($productImageIds)->isEmpty()) {
            throw new ResourceNotFoundException(sprintf("Product with id [%s] product image not found", $id));
        }

        $data = [];

        foreach ($productImageIds as $imageName) {
            $path = $this->storageService->getObject(
                sprintf("app/private/product-images/%s/%s", $id, $imageName)
            );

            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $content = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($content);
                $data[] = $base64;
            }
        }
        return $data;
    }

    public function uploadProductImage($request, $id)
    {
        if ($this->productRepo->findById($id) == null) {
            throw new ResourceNotFoundException("Product not found");
        }

        try {
            $imgName = $this->storageService->putObject('product-images/' . $id, $request->file('image'));

            $imageType = $this->usingTypeRepo->findByObj('products');
            if (!$imageType) {
                $imageType = $this->usingTypeRepo->create([
                    'obj' => 'products'
                ]);
            }

            DB::beginTransaction(); // Bắt đầu transaction

            $image = $this->imageRepo->create([
                'name' => $imgName
            ]);

            $this->usingImageRepo->create([
                'image_id' => $image['id'],
                'relation_id' => $id,
                'type_id' => $imageType['id']
            ]);

            DB::commit(); //thực hiện commit
            return $imgName;
        } catch (Exception $e) {
            DB::rollBack(); //rollback nếu sãy ra lỗi
            throw new RuntimeException("failed to upload product image");
        }
    }

    private function getImage($p)
    {
        $usingTypeId = $this->usingTypeRepo->findByObj('products')->id;

        return $p->usingImage()
            ->where('type_id', $usingTypeId)
            ->with('image') // Lấy thông tin từ bảng `images`
            ->first()?->image?->name; // Lấy `name` của ảnh đầu tiên nếu có
    }

}
