

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>
    <h1>Create Task</h1>
<form method="POST" action={{route('task.store')}}>
    @csrf
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

    @yield('content')
    
</body>
</html>