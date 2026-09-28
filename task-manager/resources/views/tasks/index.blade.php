<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #2d3436;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            color: #2c3e50;
        }

        .subtitle {
            color: #636e72;
            margin-top: 8px;
        }

        .add-button {
            background: #2c3e50;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 8px;
        }

        .add-button:hover {
            background: #1f2d3a;
        }

        .success {
            background: #dff6e4;
            color: #287a3d;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .task-card {
            background: white;
            padding: 22px;
            margin-bottom: 18px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .task-header h2 {
            margin: 0;
            color: #2c3e50;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .completed {
            background: #d4edda;
            color: #155724;
        }

        .description {
            color: #636e72;
            margin: 15px 0;
        }

        .due-date {
            font-size: 14px;
            color: #636e72;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions a,
        .actions button {
            border: none;
            padding: 8px 13px;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .edit {
            background: #e8f0fe;
            color: #1a5fb4;
        }

        .status-button {
            background: #e8f5e9;
            color: #287a3d;
        }

        .delete {
            background: #fde8e8;
            color: #b42318;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Personal Task Manager</h1>
            <p class="subtitle">Keep track of your tasks and deadlines.</p>
        </div>

        <a href="/tasks/create" class="add-button">
    + Add New Task
</a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if ($tasks->count() > 0)

        @foreach ($tasks as $task)

            <div class="task-card">

                <div class="task-header">

                    <h2>{{ $task->task_name }}</h2>

                    <span class="status {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                        {{ $task->status }}
                    </span>

                </div>

                <p class="description">
                    {{ $task->description ?: 'No description provided.' }}
                </p>

                <p class="due-date">
                    <strong>Due Date:</strong>
                    {{ $task->due_date ?: 'No due date' }}
                </p>

                <div class="actions">
              
                    <a href="/tasks/{{ $task->id }}/edit" class="edit">
    Edit
</a>
<form action="{{ env('APP_URL') }}/tasks/{{ $task->id }}/status" method="POST">                        @csrf
                        @method('PATCH')

                        <button type="submit" class="status-button">
                            Mark as {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}
                        </button>
                    </form>

                    <form
                       action="/tasks/{{ $task->id }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty">
            <h2>No tasks yet</h2>
            <p>Start organizing your work by adding your first task.</p>

           <a href="/tasks/create" class="add-button">
    + Add Your First Task
</a>
        </div>

    @endif

</div>

</body>
</html>