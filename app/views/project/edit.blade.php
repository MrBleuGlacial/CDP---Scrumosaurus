@extends('layouts.master')

@section('sidebar')
    <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li class="active"><a href="{{ URL::to('project') }}">Projets</a></li>
    </ul>
@stop


@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('/') }}">Accueil</a></li>
      <li><a href="{{ URL::to('project') }}">Projet</a></li>
      <li class="active">Edition</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Modification de {{ $project->name}}</h1>

  @if(!$errors->first() == "")
   <div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
  @endif

    {{ Form::model($project, array('route' => array('project.update', $project->id), 'method' => 'PUT')) }}

    <div class="form-group">
                {{ Form::label('name', 'Nom du Projet') }}
                {{ Form::text('name', Input::old('projectName'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
                {{ Form::label('start', 'Date de début') }}
                {{ Form::text('start', Input::old('projectBirthDay'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
                {{ Form::label('end', 'Date de fin') }}
                {{ Form::text('end', Input::old('projectEndDay'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
                {{ Form::label('git', 'Lien du GitHub') }}
                {{ Form::text('git', Input::old('projectGit'), array('class' => 'form-control')) }}
        </div>


    {{ Form::submit('Terminer les modifications', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop