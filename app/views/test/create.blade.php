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
        <li><a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id) }}">Vue de l'User Story {{$userstory->id}}</a></li>
        <li class="active">Ajouter une test à l'User Story</li>
    </ol>
@stop
@section('content')
    <h1>Création de test</h1>
    {{ HTML::ul($errors->all()) }}
    {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/test')) }}

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Créer le test', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@stop