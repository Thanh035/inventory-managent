<?php

namespace App\Services;

use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface CollectionService
{
    public function getAllManagedCollections(): AnonymousResourceCollection;

    public function getCollectionById(int $id): CollectionResource;

    public function createCollection(CollectionRequest $collectionRequest): CollectionResource;

    public function updateCollection(CollectionRequest $collectionRequest, int $id): CollectionResource;

    public function deleteCollection(int $id): void;

    public function deleteCollections(array $ids): void;
}
