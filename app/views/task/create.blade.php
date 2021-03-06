 @extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li class="active"><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}"> {{ $project->name }} </a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}"> Backlog</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id) }}">Vue de l'User Story {{$userstory->number}}</a></li>
        <li class="active">Ajouter une tâche à l'User Story</li>
    </ol>
@stop

 @section('content')
    <h1 class="page-header">Création de Tâches <small>User Story {{$userstory->number}} : {{$userstory->description}}</small></h1>

    @if(!isset($sprint->number))
        <div class="alert alert-info"><b>Cette tâche est associée à l'User Story {{$userstory->number}} qui ne fait partie d'aucun Sprint. <a class="btn btn-default btn-xs pull-right" href="{{URL::to('project/'.$project->id.'/sprint')}}">Ajouter des US à un Sprint</a></b></div>
    @else
        <div class="alert alert-info"><b>Cette tâche est associée à l'User Story {{$userstory->number}} qui fait partie du Sprint {{$sprint->number}}.</b></div>
    @endif

    {{ HTML::ul($errors->all()) }}
    {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/task')) }}

    <div class="form-group">
            {{ Form::label('developer', 'Développeur') }}
             {{ Form::select('developer', $nameContributors, Input::old('developer'), array('class' => 'form-control')) }}
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

    {{ Form::submit('Créer la tâche', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

 @stop