<?php

namespace App\Services\Impl;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use App\Repositories\CollectionRepo;
use App\Services\CollectionService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CollectionServiceImpl implements CollectionService
{
    protected CollectionRepo $collectionRepo;

    public function __construct(CollectionRepo $collectionRepo)
    {
        $this->collectionRepo = $collectionRepo;
    }

    public function getAllManagedCollections(): AnonymousResourceCollection
    {
        return CollectionResource::collection(
            $this->collectionRepo->getAll()
        );
    }

    public function createCollection(CollectionRequest $request): CollectionResource
    {
        $collection = $this->collectionRepo->create($request->all());
        return new CollectionResource($collection);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function updateCollection(CollectionRequest $request, int $id): CollectionResource
    {
        $oldCollection = $this->collectionRepo->findById($id);

        if (!$oldCollection) {
            throw new ResourceNotFoundException("Collection with id [$id] not found");
        }

        $updateCollection = $this->collectionRepo->update($request->validated(), $oldCollection);

        return new CollectionResource($updateCollection);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function getCollectionById(int $id): CollectionResource
    {
        $collection = $this->collectionRepo->findById($id);

        if (!$collection) {
            throw new ResourceNotFoundException("Collection with id[$id] not found");
        }

        return new CollectionResource($collection);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function deleteCollections(array $ids): void
    {
        foreach ($ids as $id) {
            $this->deleteCollection($id);
        }
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function deleteCollection(int $id): void
    {
        $collection = $this->collectionRepo->findById($id);
        if (!$collection) {
            throw new ResourceNotFoundException("Collection with id[$id] not found");
        }
        $this->collectionRepo->destroy($collection);
    }
}
