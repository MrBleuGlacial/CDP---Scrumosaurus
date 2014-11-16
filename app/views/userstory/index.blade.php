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

<h1>Toutes les UserStories</h1>
<a class="btn btn-primary" href="{{ URL::to('userstory/create') }}">ajouter !</a>

<?php
    //echo $projectId;
?>

<table class="table table-striped table-bordered">
 <thead>
     <tr>
         <td>#</td>
         <td>Description</td>
         <td>Priorité</td>
         <td>Difficulté</td>
         <td>Action</td>
     </tr>
 </thead>
 <tbody>
 @foreach($userstories as $key => $value)
     <tr>
         <td>{{ $value->id }}</td>
         <td>{{ $value->description }}</td>
         <td>{{ $value->priority }}</td>
         <td>{{ $value->difficulty }}</td>
         <td>
            <a href="{{ URL::to('userstory/'.$value->id . '/edit') }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> <span class="sr-only">Editer</span></a>
            {{ Form::open(array('url' => 'userstory/' . $value->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Supprimer', array('class' => 'btn btn-default')) }}
            {{ Form::close() }}
         </td>
     </tr>
 @endforeach
 </tbody>
</table>

@include('userstory.table', array('idproject'=> 0))

@stop