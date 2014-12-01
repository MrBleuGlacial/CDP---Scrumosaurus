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
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/pert') }}"><b>Pert</b> Sprint {{$sprint->number}}</a></li>
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/burndownchart') }}"><b>BurnDown Chart</b> Sprint {{$sprint->number}}</a></li>
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
        <?php $tasks =  DB::select('select tasks.* from tasks join userstories u on tasks.userstory_id = u.id join sprints s on u.sprint_id = s.id where s.id = ? and tasks.user_id = ? ', array($sprint->id, $value->id)); ?>


        <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{$value->name}} {{$value->lastname}} - {{$value->login}}</h3>
              </div>
              <div class="panel-body">
        <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">A faire</h3>
              </div>
              <div class="panel-body">
                 @foreach($tasks as $task) @if($task->status == 0) <div class="panel panel-default"><div class="panel-body">{{$task->description}}</div></div> @endif @endforeach
              </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">En cours</h3>
              </div>
              <div class="panel-body">
                 @foreach($tasks as $task) @if($task->status == 1) <div class="panel panel-default"><div class="panel-body">{{$task->description}}</div></div> @endif @endforeach
              </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Terminée</h3>
              </div>
              <div class="panel-body">
                 @foreach($tasks as $task) @if($task->status == 2) <div class="panel panel-default"><div class="panel-body">{{$task->description}}</div></div> @endif @endforeach
              </div>
            </div>
         </div>
         </div>
    </div>
     @endforeach


@stop
