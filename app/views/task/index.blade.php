    @extends('layouts.master')

@section('breadcrumb')
     <ol class="breadcrumb">
         <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
         <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
         <li><a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id) }}">{{ $userstory->name }}</a></li>
         <li class="active">Création d'une tâche</li>
     </ol>
 @stop

    @section('content')
        <h1 class="page-header">Tâches</h1>
        <a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/task/create') }}" class="btn btn-sm btn-primary glyphicon glyphicon-floppy-disk"> Enregistrer une tâche</a>
        <br/>
        <br/>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Description</td>
                    <td>Difficulté</td>
                    <td>Terminée</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($tasks as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->difficulty }}</td>
                    <td>{{ $value->done }}</td>
                    <!-- we will also add show, edit, and delete buttons -->

                    <td>
                    <a class="btn btn-small btn-info" href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/task/' . $value->id . '/edit') }}">Modifier</a>
                    {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/task/' . $value->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>




    @stop
