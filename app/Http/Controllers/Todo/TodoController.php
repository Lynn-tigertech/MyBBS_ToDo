<?php

namespace App\Http\Controllers\Todo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Services\TodoService;

class TodoController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
     public function index()
    {

        $todoService = new TodoService();
        $todos = $todoService->getAll();

        return view('todo.index')
            ->with(['todos' => $todos]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $todoService = new TodoService();
        $todostore = $todoService->getStore($request);

        return redirect()
            ->route('todo')
            ->with(['todos tore' => $todostore,
            ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $todoService = new TodoService();
        $tododelete = $todoService->getDelete($id);

        return redirect()
            ->route('todo')
            ->with(['todoelete' => $tododelete]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Request $request): \Illuminate\Http\JsonResponse
    {

        Todo::whereIn('id', explode("," , $request->ids))->delete();

        return response()->json(['success' => "Todos Deleted successfully."]);
    }

}
