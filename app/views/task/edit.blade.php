@extends('layouts.master')

@section('sidebar')
    <ul class="nav nav-sidebar">
        <li><a href="/home">Accueil</a></li>
        <li class="active"><a href="/task">Tâches</a></li>
    </ul>
@stop


@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="/home">Accueil</a></li>
      <li><a href="/project">Projet</a></li>
      <li class="active">Edition</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Modification de la tâche {{ $task->id}}</h1>

    {{ HTML::ul($errors->all()) }}

    {{ Form::model($task, array('route' => array('task.update', $task->id), 'method' => 'PUT')) }}

    <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
                {{ Form::label('difficulty', 'Difficulté') }}
                {{ Form::text('difficulty', Input::old('difficulty'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
                {{ Form::label('done', 'Terminée') }}
                {{ Form::text('done', Input::old('done'), array('class' => 'form-control')) }}
    </div>



    {{ Form::submit('Terminer les modifications', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop