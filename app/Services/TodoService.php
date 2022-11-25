<?php

namespace App\Services;
use App\Repositories\TodoRepository;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoService
{
    /**
     * getAll
     * @return String
     */
    public function getAll()
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
     * @return void
     */
    public function getDelete(int $id)
    {
        $todoRepository = new TodoRepository();
        return $todoRepository->getDelete($id);
    }

}
