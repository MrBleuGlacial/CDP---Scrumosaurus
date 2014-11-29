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
        <li class="active">Modifier un test de l'User Story</li>
    </ol>
@stop

@section('content')
    <h1>Création de test</h1>
     @if(!$errors->first() == "")
         <div class="alert alert-danger">
            {{ HTML::ul($errors->all()) }}
         </div>
        @endif
    {{ Form::model($test, array('route' => array('project.userstory.test.update', $project->id ,$userstory->id, $test->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

     <div class="form-group">
       {{ Form::label('resultat', 'Résultat') }}
       <p>
        Cochez la case si le test a validé
        {{ Form::checkbox('works', 1, Input::old('works')) }}
        </p>
        <p>Détaillez votre résultat
        {{ Form::text('result', Input::old('resultat'), array('class' => 'form-control')) }}
        </p>
    </div>

    {{ Form::submit('Sauvegarder le test', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@stop