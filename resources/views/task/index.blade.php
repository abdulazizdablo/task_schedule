@extends('layout.app')

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
        <table border="black">
            <thead>

                <td>Name</td>
                <td>Priority</td>
                <td>Created_at</td>
                <td>Updated_at</td>
                <td>Task Operations</td>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr id="task_{{ $task->name }}" draggable="true">

                        <td>{{ $task->name }}</td>
                        <td value={{ $task->priority }}>{{ $task->priority }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>{{ $task->updated_at }}</td>
                        <td><a href={{ route('task.edit', $task) }}><button> Edit</button></a>
                            <form method="POST" action={{ route('task.destroy', $task) }}>
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


                    //console.log(tbody.children.findIndex(item => item === 'tr#task_Abdulaziz Dablo4'))
                    //tbody.replaceChild(task, tbody.children[replaced_task.getAttribute("order")])
                    //tbody.replaceChild(replaced_task, tbody.children[task.getAttribute("order")])
                    //tbody.insertBefore(replaced_task, tbody.children[task.getAttribute("order")]);




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

                    console.log(new_task)
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







                    /* replaced_task.forEach(e =>replaced_task[i].textContent =  task[i].textContent )
                    replaced_task.textContent = document.querySelector('.'+task).textContent;*/

                    /* Array.from.replaced_task.forEach(e => replaced_task[i].innerText = task[i].innerText)
                     temp =  replaced_task
                     replaced_task = task
                     task = temp*/


                    /*console.log(event.target.parentNode)     

                                
                                [...event.target.parentNode].forEach(e => replaced_task.push(e.innerText))

                                const data = event.dataTransfer.getData("array");
                                // swap two arrays
                                replaced_task.splice(0, grabed_task.length, ...grabed_task);
                                grabed_task.splice(0, replaced_task.length, ...replaced_task);

                        */

                })
            </script>
    </body>
@endsection

</html>