    @extends('layouts.master')

    @section('sidebar')
          <ul class="nav nav-sidebar">
            <li><a href="/">Accueil</a></li>
            <li class="active"><a href="/projects">Projets</a></li>
          </ul>
    @stop

    @section('content')
          <h1>Projets</h1>
          <a href="/projects/create" class="btn btn-sm btn-default glyphicon glyphicon-floppy-disk">  Enregistrer un Projet</a>
    @stop