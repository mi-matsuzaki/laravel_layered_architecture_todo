@extends('layouts.app')

@section('title', $todo->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm priority-{{ $todo->priority }} {{ $todo->isCompleted() ? 'todo-completed' : '' }}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 todo-title">{{ $todo->title }}</h4>
                <div class="d-flex gap-2">
                    @include('todos._badges', ['todo' => $todo])
                </div>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">説明</dt>
                    <dd class="col-sm-9">{{ $todo->description ?? '（なし）' }}</dd>

                    <dt class="col-sm-3">期日</dt>
                    <dd class="col-sm-9">
                        {{ $todo->due_date ? $todo->due_date->format('Y年m月d日') : '（未設定）' }}
                    </dd>

                    <dt class="col-sm-3">作成日時</dt>
                    <dd class="col-sm-9">{{ $todo->created_at->format('Y年m月d日 H:i') }}</dd>

                    <dt class="col-sm-3">更新日時</dt>
                    <dd class="col-sm-9">{{ $todo->updated_at->format('Y年m月d日 H:i') }}</dd>
                </dl>
            </div>
            <div class="card-footer d-flex gap-2">
                <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn {{ $todo->isCompleted() ? 'btn-outline-secondary' : 'btn-success' }}">
                        <i class="bi bi-{{ $todo->isCompleted() ? 'arrow-counterclockwise' : 'check2' }} me-1"></i>
                        {{ $todo->isCompleted() ? '未完了に戻す' : '完了にする' }}
                    </button>
                </form>
                <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1"></i>編集
                </a>
                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST"
                    onsubmit="return confirm('このTODOを削除しますか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>削除
                    </button>
                </form>
                <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary ms-auto">
                    <i class="bi bi-arrow-left me-1"></i>一覧に戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
