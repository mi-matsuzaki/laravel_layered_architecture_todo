<div class="mb-3">
    <label for="title" class="form-label fw-bold">タイトル <span class="text-danger">*</span></label>
    <input type="text" class="form-control @error('title') is-invalid @enderror"
        id="title" name="title" value="{{ old('title', $todo->title ?? '') }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label fw-bold">説明</label>
    <textarea class="form-control @error('description') is-invalid @enderror"
        id="description" name="description" rows="4">{{ old('description', $todo->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="priority" class="form-label fw-bold">優先度 <span class="text-danger">*</span></label>
        <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
            <option value="low"    {{ old('priority', $todo->priority ?? '') === 'low'    ? 'selected' : '' }}>低</option>
            <option value="medium" {{ old('priority', $todo->priority ?? 'medium') === 'medium' ? 'selected' : '' }}>中</option>
            <option value="high"   {{ old('priority', $todo->priority ?? '') === 'high'   ? 'selected' : '' }}>高</option>
        </select>
        @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @isset($todo)
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label fw-bold">ステータス <span class="text-danger">*</span></label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
            <option value="pending"   {{ old('status', $todo->status) === 'pending'   ? 'selected' : '' }}>未完了</option>
            <option value="completed" {{ old('status', $todo->status) === 'completed' ? 'selected' : '' }}>完了</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @endisset
</div>

<div class="mb-3">
    <label for="due_date" class="form-label fw-bold">期日</label>
    <input type="date" class="form-control @error('due_date') is-invalid @enderror"
        id="due_date" name="due_date"
        value="{{ old('due_date', isset($todo) && $todo->due_date ? $todo->due_date->format('Y-m-d') : '') }}">
    @error('due_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
