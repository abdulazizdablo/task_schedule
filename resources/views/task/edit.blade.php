@extends('layout.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        <h1>Update Task</h1>
        <table border="black">
            <thead>

                <th>Name</th>
                <th>Priority</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </thead>
            <tbody>

                <tr id="task_{{ $task->name }}" draggable="true">

                    <td>{{ $task->name }}</td>
                    <td value={{ $task->priority }}>{{ $task->priority }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->updated_at }}</td>

                </tr>

            </tbody>
        </table>



        <form method="POST" action={{ route('task.update', $task->id) }}>
            @csrf
            @method('PUT')

            <div>

                <label for="name">Name</label>
                <input id="name" name="name" type="text">



            </div>

            <div>

                <label for="name">Priority</label>
                <input id="priority" name="priority" type="number" min="1">



            </div>
            <input type="submit">
        </form>

    </body>

    </html>
@endsection
