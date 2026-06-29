@extends('layouts.app')

@section('title', 'TODO新規作成')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>TODO新規作成</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    @include('todos._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy me-1"></i>保存する
                        </button>
                        <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>戻る
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
