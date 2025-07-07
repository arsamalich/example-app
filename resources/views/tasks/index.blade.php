<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Tasks</h1>

    @if(session('success'))
    <div id="flash-message" class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div id="flash-message" class="alert alert-danger">{{ session('error') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Please fix the following errors:
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = 'opacity 0.5s ease-out';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 3000); // hide after 3 seconds
    }
});
</script>


    <!-- Add New Task Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Task</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="mb-2">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Add Task</button>
            </form>
        </div>
    </div>

    <!-- Task List Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $task->updated_at->format('Y-m-d H:i') }}</td>
                    <td>
    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>

    <form class="delete-form d-inline" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">Delete</button>
    </form>
</td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this task?')) {
                    e.preventDefault();
                }
            });
        });
    });
    </script>

</body>
</html>
