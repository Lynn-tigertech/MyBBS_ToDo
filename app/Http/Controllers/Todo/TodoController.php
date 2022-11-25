<?php

namespace App\Http\Controllers\Todo;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Services\TodoService;

class TodoController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {

        $todoService = new TodoService();
        $todos = $todoService->getAll();

        return view('todo.index')
            ->with(['todos' => $todos]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $todoService = new TodoService();
        $tododelete = $todoService->getDelete($id);

        return redirect()
            ->route('todo')
            ->with(['todoelete' => $tododelete]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteAll(Request $request): JsonResponse
    {

        Todo::whereIn('id', explode("," , $request->ids))->delete();

        return response()->json(['success' => "Todos Deleted successfully."]);
    }

}
