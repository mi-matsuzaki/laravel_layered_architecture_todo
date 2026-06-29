@extends('layouts.app')

@section('title', 'TODOリスト')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">TODO一覧</h1>
    <a href="{{ route('todos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>新規作成
    </a>
</div>

{{-- フィルター --}}
<div class="btn-group mb-4" role="group">
    <a href="{{ route('todos.index') }}"
        class="btn btn-outline-secondary {{ is_null($status) ? 'active' : '' }}">
        すべて
    </a>
    <a href="{{ route('todos.index', ['status' => 'pending']) }}"
        class="btn btn-outline-secondary {{ $status === 'pending' ? 'active' : '' }}">
        <i class="bi bi-clock me-1"></i>未完了
    </a>
    <a href="{{ route('todos.index', ['status' => 'completed']) }}"
        class="btn btn-outline-secondary {{ $status === 'completed' ? 'active' : '' }}">
        <i class="bi bi-check2 me-1"></i>完了済み
    </a>
</div>

@if ($todos->isEmpty())
    <div class="text-center text-muted py-5">
        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
        <p class="fs-5">TODOがありません。</p>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">最初のTODOを作成する</a>
    </div>
@else
    <div class="row g-3">
        @foreach ($todos as $todo)
            <div class="col-12">
                <div class="card shadow-sm priority-{{ $todo->priority }} {{ $todo->isCompleted() ? 'todo-completed' : '' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <h5 class="card-title todo-title mb-0">{{ $todo->title }}</h5>
                                    @include('todos._badges', ['todo' => $todo])
                                </div>
                                @if ($todo->description)
                                    <p class="card-text text-muted small mb-1">{{ Str::limit($todo->description, 100) }}</p>
                                @endif
                                @if ($todo->due_date)
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>期日: {{ $todo->due_date->format('Y/m/d') }}
                                    </small>
                                @endif
                            </div>
                            <div class="d-flex gap-2 ms-3">
                                <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $todo->isCompleted() ? 'btn-outline-secondary' : 'btn-success' }}" title="{{ $todo->isCompleted() ? '未完了に戻す' : '完了にする' }}">
                                        <i class="bi bi-{{ $todo->isCompleted() ? 'arrow-counterclockwise' : 'check2' }}"></i>
                                    </button>
                                </form>
                                <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-sm btn-outline-primary" title="詳細">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-outline-warning" title="編集">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST"
                                    onsubmit="return confirm('このTODOを削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="削除">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
