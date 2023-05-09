<table>
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
    {{$associated_tasks}}
@endforeach
    
    
    </td>
</tr>


</tbody>
</table>