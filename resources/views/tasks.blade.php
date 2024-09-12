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
<div id="content">
    <header id="header">
        <img src="{{ asset('img/logo.png') }}" alt="logo">
    </header>
    <main>
        <div class="row">
            <div id="left-panel">
                <form id="toggle-form" method="POST" action="{{ route('tasks.store') }}">
                    {{ csrf_field() }}

                    <div class="input-group mb-3 w-100">
                        <input type="text" class="form-control w-100" placeholder="Insert task name" aria-label="Task name" name="name">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="w-full btn btn-block btn-primary" id="add-button" value="Add">
                    </div>
                </form>
            </div>
            <div id="right-panel">
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
                            <td class="{{ $task->completed_at ? 'completed' : ''  }}">{{ $task->name }}</td>
                            <td>
                                <div id="actions">
                                    @if(!$task->completed_at)
                                        <form id="toggle-form" method="POST" action="{{ route('tasks.complete', $task->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success" value="&check;">
                                            </div>
                                        </form>

                                        <form id="delete-form" method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger" value="&cross;">
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        Copyright &copy; 2020 All Rights Reserved
    </footer>
</div>
</body>
</html>

<style>
    body {
        background-color: #f1f1f1;
        color: #777;
    }
    #content {
        max-width: 60%;
        margin: auto;
    }
    .row {
        display: flex;
        justify-content: space-between;
        gap: 40px;
    }

    #left-panel {
        flex-basis: 40%;
    }

    #right-panel {
        background-color: white;
        padding: 20px 30px;
    }

    #add-button {
        margin-top: 9px;
    }

    #actions {
        display: flex;
        column-gap: 5px;
    }

    .completed {
        text-decoration: line-through;
    }

    .w-100 {
        width: 100%;
    }

    header {
        margin-bottom: 50px;
        margin-top: 20px;
    }

    footer {
        text-align: center;
    }
</style>
