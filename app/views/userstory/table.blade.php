<a href="{{ URL::to('project/'.$idProject.'/userstory/create') }}">+ ajouter une UserStory</a>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Description</td>
            <td>Priorité</td>
            <td>Difficulté</td>
        </tr>
    </thead>
    <tbody>
        @foreach($userstories as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td><a href="{{ URL::to('project/'.$idProject.'/userstory/'.$value->id) }}">{{ $value->description }}</a></td>
                <td>{{ $value->priority }}</td>
                <td>{{ $value->difficulty }}</td>
            </tr>
        @endforeach
    </tbody>
</table>