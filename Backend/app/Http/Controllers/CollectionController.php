<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use App\Services\CollectionService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CollectionController extends Controller
{
    protected CollectionService $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->collectionService->getAllManagedCollections();
    }

    public function show(int $id): CollectionResource
    {
        return $this->collectionService->getCollectionById($id);
    }

    public function store(CollectionRequest $collectionRequest): CollectionResource
    {
        return $this->collectionService->createCollection($collectionRequest);
    }

    public function update(CollectionRequest $collectionRequest, int $id): CollectionResource
    {
        return $this->collectionService->updateCollection($collectionRequest, $id);
    }


    public function destroy($id): void
    {
        $this->collectionService->deleteCollection($id);
    }

    public function deleteCollections(array $ids): void
    {
        $this->collectionService->deleteCollections($ids);
    }

}
