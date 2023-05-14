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
<td>
@foreach ($project->tasks as $associated_tasks )
<div> {{$associated_tasks}}  </div>
@endforeach
</td>
    
 
</tr>


</tbody>
</table>
@endsection