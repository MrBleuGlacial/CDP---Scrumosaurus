@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}"> Backlog</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id) }}">Vue de l'User Story {{$userstory->number}}</a></li>
        <li class="active">Edition de Tâches</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Modification de la tâche {{ $task->id}} <small>User Story {{$userstory->number}} : {{$userstory->description}}</small></h1>

    {{ HTML::ul($errors->all()) }}

    {{ Form::model($task, array('route' => array('project.userstory.task.update', $project->id ,$userstory->id, $task->id), 'method' => 'PUT')) }}

    <div class="form-group">
            {{ Form::label('developer', 'Développeur') }}
            <select class="form-control" id="developer" name="developer">
            @foreach($nameContributors as $key => $contrib)
                <option value="{{$key}}" @if($key == $task->user_id) {{ "selected=selected" }} @endif >{{$contrib}}</option>
            @endforeach
            </select>
    </div>

    <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('status', 'Statut') }}
            {{ Form::select('status', array('A faire','En cours','Terminée'), Input::old('status'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('dayfinished', 'Terminée le') }}
            {{ Form::select('dayfinished', $daysOfSprint, Input::old('dayfinished'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('dependances', 'Dépendances') }}
        <select multiple="multiple" class="form-control" name="dependances[]">
            @foreach($tasks as $aKey => $task)
                <option value="{{$task->id}}">{{ $task->description }}</option>
            @endforeach
        </select>
    </div>

    {{ Form::submit('Terminer les modifications', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop