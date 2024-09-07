<?php

namespace Modules\Core\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Core\Contracts\Repositories\ScheduleDemoRepositoryContract;
use Modules\Core\Entities\ScheduleDemo;

class ScheduleDemoRepository implements ScheduleDemoRepositoryContract
{
    public function __construct(private readonly ScheduleDemo $model)
    {
    }

    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $type
     * @param string $message
     * @return ScheduleDemo|null
     */
    public function create(string $first_name, string $last_name, string $email, string $type, string $message): ScheduleDemo|null
    {
        $objQuery = $this->model->newQuery();
        $objScheduleDemo = $objQuery->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'type' => $type,
            'message' => $message,
            'demo_uuid' => Str::uuid(),
        ]);
        return $objScheduleDemo;
    }


    /**
     * @return LengthAwarePaginator|null
     */
    public function getScheduleDemos(): ?LengthAwarePaginator
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->paginate(10);
    }


    /**
     * @param string $id
     * @return ScheduleDemo|null
     */
    public function findById(string $id): ScheduleDemo|null
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->find($id);
    }

    /**
     * @param string $strUuid
     * @return ScheduleDemo|null
     */
    public function findByUuid(string $strUuid): ScheduleDemo|null
    {
        $objQuery = $this->model->newQuery();
        return $objQuery->whereDemoUuid($strUuid)->first();
    }

}
