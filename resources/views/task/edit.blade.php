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

            <td>Name</td>
            <td>Priority</td>
            <td>Created_at</td>
            <td>Updated_at</td>
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



    <form method="POST" action={{route('task.update',$task)}}>
        @csrf
        @method('PUT')





        <div>
    
            <label for="name">Name</label>
            <input  id="name" name="name" type="text">
    
    
    
        </div>
    
        <div>
    
            <label for="name">Priority</label>
            <input id="priority" name="priority" type="number">
    
    
    
        </div>
        <input type="submit">
    </form>
    
</body>
</html>
@endsection
