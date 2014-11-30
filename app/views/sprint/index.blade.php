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

        <div class="alert alert-info">Pour ajouter des <b>User Story</b> dans un <b>Sprint</b> et avoir plus d'infos telles que le coût ou le kanban, cliquez simplement sur le <b>Sprint</b> de votre choix.</div>
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>{{ Session::get('message') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>Numéro du Sprint</td>
                    <td>Durée</td>
                    <td>Date de début</td>
                    <td style="width:180px">Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($sprints as $key => $value)
                <tr>
                    <td><a href="{{ URL::to('/project/'.$project->id.'/sprint/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">Sprint {{ $value->number }}</a></td>
                    <td><a href="{{ URL::to('/project/'.$project->id.'/sprint/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->duration }} jour(s)</a></td>
                    <td><a href="{{ URL::to('/project/'.$project->id.'/sprint/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->begin }}</a></td>

                    <td style="width:180px">
                        <a class="btn btn-sm btn-info" href="{{ URL::to('project/'.$project->id.'/sprint/'.$value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
                        {{ Form::open(array('url' => 'project/'.$project->id.'/sprint/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
                        {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        </div>
    </div>
@stop
