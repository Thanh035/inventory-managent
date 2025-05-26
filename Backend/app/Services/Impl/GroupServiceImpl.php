<?php

namespace App\Services\Impl;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\GroupViewResource;
use App\Repositories\GroupRepo;
use App\Services\GroupService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Throwable;

class GroupServiceImpl implements GroupService
{
    protected GroupRepo $groupRepo;

    public function __construct(GroupRepo $groupRepo)
    {
        $this->groupRepo = $groupRepo;
    }

    public function getAll(): AnonymousResourceCollection
    {
        return GroupResource::collection(
            $this->groupRepo->getAll()
        );
    }

    /**
     * @throws Throwable
     */
    public function create(GroupRequest $request): GroupResource|null
    {
        DB::beginTransaction();

        try {
            $group = $this->groupRepo->create([
                'name' => $request['name'],
                'code' => $request['code'],
                'note' => $request['note'] ?? null,
                'created_by' => auth()->id(),
                'guard_name' => 'api'
            ]);

            if (!empty($request['permissions'])) {
                $group->syncPermissions($request['permissions']);
            }

            DB::commit();
            return new GroupResource($group);
        } catch (Exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @throws Throwable
     */
    public function update(GroupRequest $request, int $id): GroupResource|null
    {
        DB::beginTransaction();

        try {
            $group = $this->groupRepo->findById($id);

            if (is_null($group)) {
                throw new ResourceNotFoundException("Group with id [$id] not found");
            }

            $group->update([
                'name' => $request['name'],
                'code' => $request['code'],
                'note' => $request['note'] ?? null,
                'updated_by' => auth()->id(),
            ]);

            if (!empty($request['permissions'])) {
                $group->syncPermissions($request['permissions']);
            }

            DB::commit();

            return new GroupResource($group);
        } catch (Exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function findById(int $id): GroupViewResource
    {
        $group = $this->groupRepo->findById($id);

        if (is_null($group)) {
            throw new ResourceNotFoundException("Group with id [$id] not found");
        }

        return new GroupViewResource($group);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function destroy(int $id): void
    {
        $group = $this->groupRepo->findById($id);
        if (is_null($group)) {
            throw new ResourceNotFoundException("Group with id[$id] not found");
        }
        $this->groupRepo->destroy($group);
    }
}
