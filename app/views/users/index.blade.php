@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="/">Accueil</a></li>
        <li class="active"><a href="/users/create">S'inscrire</a></li>
      </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
       <li><a href="/">Accueil</a></li>
       <li class="active">S'inscrire</li>
    </ol>
 @stop

@section('content')
    <h1 class="page-header">S'inscrire</h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">


            @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            </div>
        </div>
    </div>
@stop