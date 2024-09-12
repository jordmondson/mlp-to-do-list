@extends('layouts.layout')

@section('main')
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
                @foreach($tasks as $index => $task)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
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
@endsection
