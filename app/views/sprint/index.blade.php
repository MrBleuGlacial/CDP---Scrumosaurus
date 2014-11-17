@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Tâches</a></li>
      <li class="active"><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li class="active">Sprints</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Sprints</h1>
    <div class="container-fluid">
        <div class="row">

        <a class="btn btn-primary" href="{{  URL::to('project/'.$project->id.'/sprint/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter un Sprint</a>
        <br/>
        <br/>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Numéro du Sprint</td>
                    <td>Durée</td>
                    <td>Date de début</td>
                    <td>Date de fin</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($sprints as $key => $value)
                <tr>
                    <td>Sprint {{ $value->number }}</td>
                    <td>{{ $value->duration }}</td>
                    <td>{{ $value->begin }}</td>
                    <td>{{ $value->end }}</td>

                    <td>

                        <a class="btn btn-small btn-info" href="{{ URL::to('project/' . $value->id . '/edit') }}">Modifier</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        </div>
    </div>
@stop
