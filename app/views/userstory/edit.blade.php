@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="/">Accueil</a></li>
        <li class="active"><a href="/register">S'inscrire</a></li>
      </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
      <li><a href="/">Accueil</a></li>
      <li><a href="/">Projet</a></li>
      <li class="active">User Story</li>
    </ol>
@stop

@section('content')
    {{ HTML::ul($errors->all()) }}
    {{ Form::model($userstory, array('route' => array('userstory.update', $userstory->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{ Form::label('name', 'Nom') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('priority', 'Priorité') }}
            {{ Form::select('priority', array('1', '2', '3', '5', '8'), Input::old('priority'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
                    {{ Form::label('difficulty', 'Difficulté') }}
                    {{ Form::select('difficulty', array('1', '2', '3', '5', '8'), Input::old('difficulty'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Enregistrer', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@stop