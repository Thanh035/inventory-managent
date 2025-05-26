<?php

namespace App\Services;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupViewResource;

interface GroupService
{
    public function getAll();

    public function findById(int $id): GroupViewResource;

    public function create(GroupRequest $request): GroupResource|null;

    public function update(GroupRequest $request, int $id): GroupResource|null;

    public function destroy(int $id): void;

}
