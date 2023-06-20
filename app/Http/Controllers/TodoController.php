<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagTodo;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Todo::class, 'todo');
    }

    public function index(Request $request)
    {
        $tags = Tag::all();

        $todos = Todo::query()
            ->with('tags')
            ->where('user_id', Auth::id())
            ->search($request)
            ->get();

        return view('todo.index', compact('todos', 'tags'));
    }

    public function create()
    {
        $tags = Tag::all();

        return view('todo.create', compact('tags'));
    }

    public function store(StoreTodoRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('img')->store('img/todos', 'public');

        $todo = Todo::query()->create([
            'title' => $data['title'],
            'img' => $file,
            'user_id' => Auth::id(),
        ]);

        foreach ($data['tags'] as $tag) {
            TagTodo::query()->create([
                'tag_id' => $tag,
                'todo_id' => $todo->id
            ]);
        }

        return to_route('todos.index')->with('success', 'Todo успешно добавлена');
    }


    public function show(Todo $todo)
    {
        return view('todo.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        $tags = Tag::all();

        return view('todo.edit', compact('todo', 'tags'));
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $path = '/public/' . $todo->img;
            Storage::delete($path);

            $file = $request->file('img')->store('img/todos', 'public');
        } else {
            $file = $todo->img;
        }


        $todo->update([
            'title' => $data['title'],
            'img' => $file,
        ]);

        TagTodo::query()->where('todo_id', $todo->id)->delete();

        foreach ($data['tags'] as $tag) {
            TagTodo::query()->create([
                'tag_id' => $tag,
                'todo_id' => $todo->id
            ]);
        }

        return to_route('todos.index')->with('success', 'Todo успешно изменен');
    }

    public function destroy(Todo $todo)
    {
        $path = '/public/' . $todo->img;

        Storage::delete($path);

        $todo->delete();

        return to_route('todos.index')->with('success', 'Todo успешно удален');
    }
}
