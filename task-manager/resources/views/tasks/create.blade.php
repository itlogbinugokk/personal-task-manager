<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Task</title>

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
            max-width: 650px;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #2c3e50;
        }

        .back {
            display: inline-block;
            margin-bottom: 25px;
            color: #636e72;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #dfe6e9;
            border-radius: 7px;
            font-family: inherit;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #2c3e50;
        }

        .error {
            background: #fde8e8;
            color: #b42318;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #2c3e50;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #1f2d3a;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('tasks.index') }}" class="back">
        ← Back to Tasks
    </a>

    <div class="card">

        <h1>Add New Task</h1>

        <p>Create a task and keep track of its progress.</p>

        @if ($errors->any())
            <div class="error">

                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <form action="/tasks" method="POST">

            @csrf

            <div class="form-group">
                <label for="task_name">Task Name</label>

                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ old('task_name') }}"
                    placeholder="Enter task name"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Enter task description"
                >{{ old('description') }}</textarea>
            </div>

          <div class="form-group">
    <label for="status">Status</label>

    <select id="status" name="status" required>
        <option value="Pending" {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>
            Completed
        </option>
    </select>
</div>

            <div class="form-group">
                <label for="due_date">Due Date</label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                >
            </div>

            <button type="submit" class="submit-button">
                Add Task
            </button>

        </form>

    </div>

</div>

</body>
</html>