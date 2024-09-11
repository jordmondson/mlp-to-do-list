<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<div class="container-fluid" id="content">
    <header>
        <img src="{{ asset('img/logo.png') }}" alt="logo">
    </header>
    <main>
        <div>
            <div>

                <form id="toggle-form" method="POST" action="{{ route('tasks.store') }}">
                    {{ csrf_field() }}

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Insert task name" aria-label="Task name" name="name">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>
                </form>
            </div>
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->id }}</th>
                                <td>{{ $task->name }}</td>
                                <td>
                                    @if(!$task->completed_at)
                                        <form id="delete-form" method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </div>
                                        </form>

                                        <form id="toggle-form" method="POST" action="{{ route('tasks.complete', $task->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger" value="Complete">
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </main>
</div>
</body>
</html>
