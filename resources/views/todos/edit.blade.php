@extends('layouts.app')

@section('title', 'TODO編集')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning">
                <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>TODO編集</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('todos._form', ['todo' => $todo])
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-floppy me-1"></i>更新する
                        </button>
                        <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>戻る
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
