@extends('layout.app')
@section('content')
<table border="black">
<thead>
<tr>

<td>Project</td>
<td>Related Tasks</td>
</tr>


</thead>

<tbody>
<tr>
<td>

{{$project->project}}

</td>

@foreach ($project->tasks as $associated_tasks )
<td> {{$associated_tasks}}   </td>
@endforeach
    
    
 
</tr>


</tbody>
</table>
@endsection