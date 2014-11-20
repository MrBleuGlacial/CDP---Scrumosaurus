    @extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li class="active"><a href="{{ URL::to('project/'.$project->id.'/task') }}">Tâches</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li class="active">Tâches</li>
    </ol>
@stop

    @section('content')
        <h1 class="page-header">Tâches</h1>
        <a href="{{  URL::to('project/'.$project->id.'/task/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une tâche</a>
        <br/>
        <br/>

         @if (Session::has('message'))
         <div class="alert alert-success">{{ Session::get('message') }}</div>
         @endif


        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Description</td>
                    <td>Difficulté</td>
                    <td>Terminée</td>
                    <td style="width:180px">Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($task as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ Task::transcriptDifficulty($value->difficulty) }}</td>
                    <td>{{ Task::transcriptDone($value->done) }}</td>
                    <!-- we will also add show, edit, and delete buttons -->

                    <td style="width:180px">
                    <a class="btn btn-sm btn-info" href="{{ URL::to('project/'.$project->id.'/task/'.$value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
                    {{ Form::open(array('url' => 'project/'.$project->id.'/task/' . $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
                    {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>




    @stop
