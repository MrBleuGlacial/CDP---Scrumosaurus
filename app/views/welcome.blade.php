    @extends('layouts.master')

    @section('sidebar')
          <ul class="nav nav-sidebar">
            <li class="active"><a href="/">Accueil</a></li>
            <li><a href="/projects">Projets</a></li>
          </ul>
    @stop

    @section('breadcrumb')
        <ol class="breadcrumb">
          <li class="active">Accueil</li>
        </ol>
    @stop

    @section('content')
             <h1 class="page-header">Welcome</h1>
             <p> Bonjour !</p>
    @stop