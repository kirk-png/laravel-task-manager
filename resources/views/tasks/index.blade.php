@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card total">
                <div class="small text-uppercase opacity-75">Total Tasks</div>
                <div class="fs-2 fw-bold">{{ $pendingCount + $completedCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card pending">
                <div class="small text-uppercase opacity-75">Pending</div>
                <div class="fs-2 fw-bold">{{ $pendingCount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card completed">
                <div class="small text-uppercase opacity-75">Completed</div>
                <div class="fs-2 fw-bold">{{ $completedCount }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-bold">All Tasks</h5>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('tasks.index') }}"
                       class="btn {{ request('status') ? 'btn-outline-secondary' : 'btn-secondary' }}">All</a>
                    <a href="{{ route('tasks.index', ['status' => 'Pending']) }}"
                       class="btn {{ request('status') === 'Pending' ? 'btn-secondary' : 'btn-outline-secondary' }}">Pending</a>
                    <a href="{{ route('tasks.index', ['status' => 'Completed']) }}"
                       class="btn {{ request('status') === 'Completed' ? 'btn-secondary' : 'btn-outline-secondary' }}">Completed</a>
                </div>
            </div>

            @if ($tasks->isEmpty())
                <div class="text-center text-muted py-5">
                    <i class="fa-regular fa-clipboard fa-2x mb-3"></i>
                    <p class="mb-3">No tasks yet. Start by adding your first task.</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus me-1"></i> Add Task
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="fw-semibold">{{ $task->task_name }}</td>
                                    <td class="text-muted" style="max-width: 300px;">
                                        {{ Str::limit($task->description, 60) ?: '—' }}
                                    </td>
                                    <td>
                                        {{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill {{ $task->status === 'Pending' ? 'badge-status-pending' : 'badge-status-completed' }}">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            {{-- Quick status toggle --}}
                                            <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status"
                                                       value="{{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}">
                                                <button type="submit" class="btn btn-sm btn-soft-primary" title="Toggle status">
                                                    <i class="fa-solid fa-rotate"></i>
                                                    {{ $task->status === 'Pending' ? 'Mark Done' : 'Mark Pending' }}
                                                </button>
                                            </form>

                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                  onsubmit="return confirm('Delete this task? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
