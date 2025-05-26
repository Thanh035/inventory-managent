<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupViewResource;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index()
    {
        return $this->groupService->getAll();
    }

    public function store(GroupRequest $request): GroupResource
    {
        return $this->groupService->create($request);
    }

    public function show(int $id): GroupViewResource
    {
        return $this->groupService->findById($id);
    }

    public function update(GroupRequest $request, int $id): GroupResource
    {
        return $this->groupService->update($request, $id);
    }

    public function destroy(int $id): void
    {
        $this->groupService->destroy($id);
    }
}
