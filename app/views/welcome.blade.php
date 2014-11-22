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

          @if (Session::has('message'))
          <div class="alert alert-success">{{ Session::get('message') }}</div>
          @endif


         <div class="jumbotron">
            <div class="container">
                <h1>Gérez vos projets en toute simplicité !</h1>
                <p> Bonjour ! <br/>
                    Créez vous un compte dans la barre principale en haut !<br/>
                    Et si vous n'avez pas encore de projet, créez en un dans la colonne de gauche ...</p>
            </div>
         </div>

         <div align="center">
            <p><b>Tyrannosaurus rex approves this tool !</b></p>
            <img src="assets/img/trex.png" alt="trex"/>
         </div>
@stop