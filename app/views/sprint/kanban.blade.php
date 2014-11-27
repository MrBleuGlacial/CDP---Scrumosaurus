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

    <ul class="nav nav-sidebar">
      <li class="active"><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/kanban') }}">Kanban Sprint {{$sprint->number}}</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/sprint/'.$sprint->id) }}">Vue d'un Sprint</a></li>
        <li class="active">Kanban d'un Sprint</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Sprint {{$sprint->number}}</h1>

        <h3 class="page-header">Kanban du Sprint {{$sprint->number}}</h3>

    @foreach($contributors as $key => $value)
        <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">A faire</h3>
              </div>
              <div class="panel-body">
                 <div class="col-md-4"><div class="panel panel-default"><div class="panel-body">Tâche 1</div></div></div>
              </div>
              <div class="panel-footer">{{$value->name}} {{$value->lastname}} - {{$value->login}}</div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">En cours</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4"><div class="panel panel-default"><div class="panel-body">Tâche 2</div></div></div>
              </div>
              <div class="panel-footer">{{$value->name}} {{$value->lastname}} - {{$value->login}}</div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Fait</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4"><div class="panel panel-default"><div class="panel-body">Tâche 3</div></div></div>
                <div class="col-md-4"><div class="panel panel-default"><div class="panel-body">Tâche 4</div></div></div>
              </div>
              <div class="panel-footer">{{$value->name}} {{$value->lastname}} - {{$value->login}}</div>
            </div>
         </div>
     @endforeach


@stop
