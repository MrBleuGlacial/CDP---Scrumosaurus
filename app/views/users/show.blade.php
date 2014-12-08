@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li class="active"><a href="{{ URL::to('/users/'.Auth::user()->id) }}">Mon Profil</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li class="active">Mon Profil</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Mon Profil</h1>
                @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
    <div class="well">
        <div class="row">
        <div class="col-xs-4">
            <p class="text-left"><span class="glyphicon glyphicon-user"></span> Nom</p>
            <p class="text-left"><span class="glyphicon glyphicon-off"></span> Login</p>
            <p class="text-left"><span class="glyphicon glyphicon-envelope"></span> E-mail</p>
        </div>
        <div class="col-xs-8">
            <p class="text-left">{{Auth::user()->name}} {{Auth::user()->lastname}}</p>
            <p class="text-left">{{Auth::user()->login}}</p>
            <p class="text-left"><a href='mailto:{{Auth::user()->email}}'>{{Auth::user()->email}}</a></p>
        </div>
        </div>
    </div>

    <a href="{{URL::to('users/'.Auth::user()->id.'/edit/')}}" class="btn btn-primary">Modifier mon profil</a>
@stop