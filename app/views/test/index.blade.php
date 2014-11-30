<h2 class="page-header">Tests</h2>
<a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/test/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un test</a>
<br/>
<br/>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>Description</td>
            <td>Testé par</td>
            <td>Date</td>
            <td>Résultat</td>
            <td>Détail</td>
            <td style="width:180px">Actions</td>
        </tr>
    </thead>
    <tbody>
    @if (count($tests)==0)
        <tr>
            <td>Il n'y a pas encore de tests enregistrés pour cette UserStory</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
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

                <td style="width:180px">
                <a class="btn btn-sm btn-info" href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/test/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
                {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/test/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
                {{ Form::close() }}
                </td>

            </tr>
        @endforeach
    @endif
    </tbody>
</table>
