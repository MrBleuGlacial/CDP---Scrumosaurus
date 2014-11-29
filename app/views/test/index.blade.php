<h1 class="page-header">Tests</h1>
<a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/test/create') }}" class="btn btn-sm btn-primary glyphicon glyphicon-floppy-disk"> Enregistrer un test</a>
<br/>
<br/>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Description</td>
            <td>Testé par</td>
            <td>Il y a</td>
            <td>Résultat</td>
            <td>Détail</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @if (count($tests)==0)
        <tr>
            <td>Il n'y a pas encore de test enregistré pour cette UserStory</td>
        </tr>
    @else
        @foreach($tests as $key => $value)
            <tr>
                <td>{{ $value->description }}</td>
                <td>{{ $value->testeur() }}</td>
                <td>{{ $value->date }}</td>
                <td>
                    @if ($value->works == 1)
                         <span class="glyphicon glyphicon glyphicon-thumbs-up"></span>
                    @else
                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                    @endif
                </td>
                <td>{{ $value->result }}  </td>

                <td>
                <a class="btn btn-small btn-info" href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/test/' . $value->id . '/edit') }}">Modifier</a>
                {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/test/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                </td>

            </tr>
        @endforeach
    @endif
    </tbody>
</table>
