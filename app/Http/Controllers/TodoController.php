<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Services\TodoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function __construct(private readonly TodoService $todoService) {}

    public function index(Request $request): View
    {
        $status = $request->query('status');

        $todos = $status
            ? $this->todoService->getTodosByStatus($status)
            : $this->todoService->getAllTodos();

        return view('todos.index', compact('todos', 'status'));
    }

    public function create(): View
    {
        return view('todos.create');
    }

    public function store(StoreTodoRequest $request): RedirectResponse
    {
        $this->todoService->createTodo($request->validated());

        return redirect()->route('todos.index')->with('success', 'TODOを作成しました。');
    }

    public function show(int $id): View
    {
        $todo = $this->todoService->getTodoById($id);

        return view('todos.show', compact('todo'));
    }

    public function edit(int $id): View
    {
        $todo = $this->todoService->getTodoById($id);

        return view('todos.edit', compact('todo'));
    }

    public function update(UpdateTodoRequest $request, int $id): RedirectResponse
    {
        $this->todoService->updateTodo($id, $request->validated());

        return redirect()->route('todos.index')->with('success', 'TODOを更新しました。');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->todoService->deleteTodo($id);

        return redirect()->route('todos.index')->with('success', 'TODOを削除しました。');
    }

    public function toggleStatus(int $id): RedirectResponse
    {
        $this->todoService->toggleStatus($id);

        return redirect()->back()->with('success', 'ステータスを変更しました。');
    }
}
