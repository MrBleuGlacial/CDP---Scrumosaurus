@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li class="active"><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/kanban') }}">Kanban Sprint {{$sprint->number}}</a></li>
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
        <li class="active">Vue d'un Sprint</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Sprint {{$sprint->number}}</h1>
    <div class="container-fluid">
        <div class="row">
        <h3 class="page-header">User Stories du Sprint</h3>
             @if (sizeof($userStoriesOfSprint) == 0)
             <div class="alert alert-info">Ce Sprint ne contient pas d'User Stories.</div>
             @endif

            <?php $cout = 0 ?>
            <div class="list-group">
            @foreach($userStoriesOfSprint as $key => $value)
                <?php $cout += $value->difficulty ?>
                <a href="{{$sprint->id}}/delete/{{$value->id}}" class="list-group-item ">US{{ $value->number }} : {{ $value->description }} ---- Coût : {{$value->difficulty}} <span class="glyphicon glyphicon-minus pull-right" aria-hidden="true"></span></a>
            @endforeach
            </div>

            <div class="panel panel-default">
              <div class="panel-body">
                Coût du Sprint : {{$cout}}
              </div>
            </div>

        <h3 class="page-header">User Stories disponibles</h3>
             @if (sizeof($userStoriesAvailable) == 0)
             <div class="alert alert-info">Ce Projet ne contient pas d'User Stories ou elles sont toutes affectées à des Sprints. </div>
             @endif

            <div class="list-group">
                @foreach($userStoriesAvailable as $key => $value)
                    <a href="{{$sprint->id}}/add/{{$value->id}}" class="list-group-item">US{{ $value->number }} : {{ $value->description }} ---- Coût : {{$value->difficulty}} <span class="glyphicon glyphicon-plus pull-right" aria-hidden="true"></span></a>
                @endforeach
            </div>
        </div>
    </div>
@stop
