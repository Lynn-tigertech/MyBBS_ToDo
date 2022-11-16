<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todo.index')
            ->with(['todos' => $todos]);
    }

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

    public function destroy($id)
    {
        $todo->delete();

        return redirect()
            ->route('todo');
    }

}
