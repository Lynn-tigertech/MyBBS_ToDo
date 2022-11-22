<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todo.index')
            ->with(['todos' => $todos]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->save();

        return redirect()
            ->route('todo');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {

        $todo = Todo::find($id);
        $todo->delete();

        return redirect()
            ->route('todo');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Request $request)
    {

        Todo::whereIn('id', explode("," , $request->ids))->delete();

        return response()->json(['success'=>"Todos Deleted successfully."]);
    }
}
