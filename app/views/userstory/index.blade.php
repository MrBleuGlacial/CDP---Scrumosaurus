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
        <li class="active">Backlog</li>
    </ol>
@stop

@section('content')

<h1 class="page-header">Backlog</h1>
<a class="btn btn-primary" href="{{  URL::to('project/'.$project->id.'/userstory/create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une User Story</a>
<br/>
<br/>

<div class="alert alert-info">Pour ajouter des <b>Tâches</b> et des <b>Tests</b> dans une <b>UserStory</b> cliquez simplement sur l'<b>User Story</b> de votre choix.</div>
 @if (Session::has('message'))
 <div class="alert alert-success">{{ Session::get('message') }}</div>
 @endif

<table class="table table-bordered table-hover">
 <thead>
     <tr>
         <td>#</td>
         <td>Description</td>
         <td>Priorité</td>
         <td>Coût</td>
         <td style="width:180px">Action</td>
     </tr>
 </thead>
 <tbody>
 @foreach($userstories as $key => $value)
     <tr>
         <td><a href="{{ URL::to('/project/'.$project->id.'/userstory/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">US{{ $value->number }}</a></td>
         <td><a href="{{ URL::to('/project/'.$project->id.'/userstory/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->description }}</a></td>
         <td><a href="{{ URL::to('/project/'.$project->id.'/userstory/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{  $value->priority }}</a></td>
         <td><a href="{{ URL::to('/project/'.$project->id.'/userstory/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->difficulty }}</a></td>
         <td style="width:180px">
            <a href="{{ URL::to('project/'.$project->id.'/userstory/'.$value->id . '/edit') }}" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
            {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/' . $value->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
            {{ Form::close() }}
         </td>
     </tr>
 @endforeach
 </tbody>
</table>

@stop