@extends('layouts.master')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li class="active">Ajout d'une UserStory</li>
    </ol>
@stop

@section('content')

    {{ HTML::ul($errors->all()) }}
    {{ Form::open(array('url' => 'project/'.$project->id.'/userstory')) }}

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