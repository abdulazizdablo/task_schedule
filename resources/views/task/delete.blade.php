{{--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action={{route('task.destroy'),$task}}>
    @csrf
    @method('DELETE')
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

        <input type="submit" placeholder="Delete">
    </form>
</body>
</html>