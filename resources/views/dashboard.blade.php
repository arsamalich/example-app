<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Tasks Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Dashboard</h1>
<div class="row mb-4">
    <div class="col">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Tasks</h5>
                <p class="card-text fs-3">{{ $totalTasks }}</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Pending Tasks</h5>
                <p class="card-text fs-3 text-warning">{{ $pendingTasks }}</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Completed Tasks</h5>
                <p class="card-text fs-3 text-success">{{ $completedTasks }}</p>
            </div>
        </div>
    </div>
</div>

    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Manage Tasks</a>
    </div>

    @if($tasks->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            <span class="badge {{ $task->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks found.</p>
    @endif
</body>
</html>
