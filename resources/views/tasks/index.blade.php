@extends('layout.app')
@include('tasks.create')
@section('content')
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
@foreach($errors->all() as $error)
{{$error}}
@endforeach
        <form method="POST" action="">
            <label for="projects">Pick your project</label>

            <select name="projects" id="projects" placeholder="select">
                <option value="" selected disabled></option>
                @foreach ($projects as $project)
                    <option value={{ $project->name }}>{{ $project->name }}</option>
                @endforeach
            </select>

        </form>

        <hr>

        <table border="black">
            <thead>

                <th>Name</th>
                <th>Priority</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Task Operations</th>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr id="task_{{ $task->name }}" draggable="true">

                        <td>{{ $task->name }}</td>
                        <td value={{ $task->priority }}>{{ $task->priority }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{{ $task->updated_at }}</td>
                        <td><a href={{ route('tasks.edit', $task) }}><button> Edit</button></a>
                            <form method="POST" action={{ route('tasks.destroy', $task) }}>
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"
                integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

            <script defer>
                document.addEventListener("dragstart", function(event) {


                    event.dataTransfer.setData("Text", event.target.id);


                })

                document.addEventListener("dragover", function(event) {

                    event.preventDefault();

                })

                document.addEventListener("drop", function(event) {
                    event.preventDefault();
                    let task_id = event.dataTransfer.getData("Text");

                    let task = document.getElementById(task_id)
                    let replaced_task = event.target.parentNode
                    let tbody = document.querySelector('tbody')

                    if (event.target.nodeName == 'TD')
                        var temp = []
                    var new_task
                    var previous_task

                    for (var i = 0; i < replaced_task.children.length - 2; i++) {


                        temp[i] = replaced_task.children[i].textContent

                        replaced_task.children[i].textContent = task.children[i].textContent

                        task.children[i].textContent = temp[i]
                        new_task = temp[1]
                        previous_task = replaced_task.children[1].textContent


                    }

                
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('reorder') }}",

                        data: {
                            "new_task": new_task,
                            "previous_task": previous_task
                        },

                        success: function(data) {


                            var task_one = document.querySelector(`[value="${data.task_one_priority}"]`)
                            var task_two = document.querySelector(`[value="${data.task_two_priority}"]`)


                            task_one.innerHTML = data.task_one_priority
                            task_two.innerHTML = data.task_two_priority

                            event.preventDefault();


                        }
                    });

                })




                $('select').on('change', function(e) {
                    let project = e.target.value

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('associated-tasks') }}",

                        data: {
                            "project": project

                        },

                        success: function(data) {

                            if (data.success == true) {
                                $('html').html(data.html);
                            }

                        }

                    })

                })
            </script>
    </body>
@endsection

</html>
