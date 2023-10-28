<h1>Create Task</h1>
<form method="POST" action={{route('tasks.store')}}>

    <div>

        <label for="name">Name</label>
        <input  id="name" name="name" type="text">



    </div>

    <div>

        <label for="priority">Priority</label>
        <input id="priority" name="priority" type="number" min="1">



    </div>
    <div>

        <label for="project">Project</label>
        <input id="project" name="project" type="text" >



    </div>
    <input type="submit">
        @csrf
</form>
