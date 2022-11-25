<?php

namespace App\Services;
use App\Repositories\TodoRepository;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TodoService
{
    /**
     * getAll
     * @return Collection
     */
    public function getAll(): Collection
    {
        $todoRepository = new TodoRepository();
        return $todoRepository->getAll();
    }

    /**
     * getStore
     * @param Request $request
     * @return Todo|null
     */
    public function getStore(Request $request): ?Todo
    {
        $todoRepository = new TodoRepository();
        return $todoRepository->getStore($request);
    }

    /**
     * getDelete
     * @param int $id
     * @return int|null
     */
    public function getDelete(int $id): ?int
    {
        $todoRepository = new TodoRepository();
        return $todoRepository->getDelete($id);
    }

}
