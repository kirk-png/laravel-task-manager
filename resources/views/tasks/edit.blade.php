@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="fa-solid fa-pen me-2 text-primary"></i>Edit Task</h5>

                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Task Name</label>
                            <input type="text" name="task_name" class="form-control @error('task_name') is-invalid @enderror"
                                   value="{{ old('task_name', $task->task_name) }}" required>
                            @error('task_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
                                       value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}">
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-check me-1"></i> Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
