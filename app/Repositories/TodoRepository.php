<?php

namespace App\Repositories;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoRepository
{
    /**
     * getAll
     * @return mixed
     */
    public function getAll()
    {
        return Todo::latest()->get();
    }

    /**
     * getStore
     * @param Request $request
     * @return Todo|null
     */
    public function getStore(Request $request): ?Todo
    {
        $request->validate([
            'title' => 'required',
        ]);
        $todo = new todo;
        $todo->title = $request['title'];
        $todo->save();

        return $todo->fresh();
    }

    /**
     * getDelete
     * @param $id
     * @return mixed
     */
    public function getDelete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return $todo->fresh();
    }

}
