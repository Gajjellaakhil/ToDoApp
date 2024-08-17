<!DOCTYPE html>
<html>
<head>
    <title>ToDo App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body, html {
            height: 10%;
            margin: 0;
            background-color: #d5f5e9;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }

        .group-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            
            text-align: center;
        }

        .todo-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color:#f0f0f0;
        }

        .group-list, .todo-list {
            margin: 0;
            padding: 5px;
        }

        .group-list li, .todo-list li {
            margin-bottom: 10px;
            list-style-type: none;
        }

        .group-list form, .todo-list form {
            display: inline-block;
            margin-right: 10px;
            margin-top: 15px;
        }

        .todo-actions {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px; /* Space between buttons */
        }

        .todo-actions form {
            display: inline-block;
        }

        h1 {
            padding-top: 20px; /* Add padding to the top of the title */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-8">
            <h1 class="text-center">ToDoApp</h1>

            <div class="group-container">
                <form action="{{ route('groups.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Group name" required>
                    <button type="submit" class="btn btn-primary">Add Group</button>
                </form>
            </div>

            <ul class="group-list">
                @foreach($groups as $group)
                    <li>
                        <div class="group-container">
                            <form action="{{ route('groups.update', $group->id) }}" method="POST" style="margin-bottom: 10px;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $group->name }}" required>
                                <button type="submit" class="btn btn-warning">Update</button>
                                <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </form>

                            <h3>{{ $group->name }}</h3>

                            <form action="{{ route('todos.store') }}" method="POST">
                                @csrf
                                <input type="text" name="title" placeholder="Todo title" required>
                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                <button type="submit" class="btn btn-success">Add Todo</button>
                            </form>

                            <!-- Todos List -->
                            <ul class="todo-list">
                                @foreach($group->todos as $todo)
                                    <li>
                                        <div class="todo-container">
                                            <div class="todo-actions">
                                                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="title" value="{{ $todo->title }}" required>
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                </form>

                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                                <form action="{{ route('todos.toggleComplete', $todo->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info">{{ $todo->is_complete ? 'Mark as Incomplete' : 'Mark as Complete' }}</button>
                                                </form>
                                            </div>

                                            {{ $todo->title }} - {{ $todo->is_complete ? 'Complete' : 'Incomplete' }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
