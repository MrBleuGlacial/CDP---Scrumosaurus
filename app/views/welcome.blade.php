@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
            <li class="active"><a href="/">Accueil</a></li>
            <li><a href="/project">Projets</a></li>
      </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active">Accueil</li>
    </ol>
@stop

@section('content')
         <h1 class="page-header">Bienvenue sur Scrumosaurus</h1>
         <p> Bonjour !</p>
         <p> Si vous n'avez pas encore de projet créez en un dans la colonne de gauche ...</p>
@stop