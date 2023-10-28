@extends('layout.app')
@section('content')
    <table border="black">
        <thead>
            <tr style="width: 100%">

                <th rowspan="99">Project</th>
                <th colspan="5">Related Tasks</th>

            </tr>
            <tr>

                <th colspan="4">Name</th>
                <th colspan="3">Priority</th>


            </tr>

        </thead>

        <tbody>
            <tr>
                <td rowspan="99" colspan="4">

                    {{ $project->name }}

                </td>
            </tr>
            @foreach ($project->tasks as $associated_tasks)
                <tr>
                    <td>{{ $associated_tasks->name }}</td>
                    <td>{{ $associated_tasks->priority }}</td>
                </tr>
            @endforeach



            </tr>


        </tbody>
    </table>
@endsection
