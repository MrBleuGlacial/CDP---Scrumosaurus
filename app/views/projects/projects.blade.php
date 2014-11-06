    @extends('layouts.master')

    @section('sidebar')
          <ul class="nav nav-sidebar">
            <li><a href="/">Accueil</a></li>
            <li class="active"><a href="/projects">Projets</a></li>
          </ul>
    @stop

        @section('breadcrumb')
            <ol class="breadcrumb">
              <li><a href="/">Accueil</a></li>
              <li class="active">Projets</li>
            </ol>
        @stop

    @section('content')
             <h1 class="page-header">Projets</h1>
    @stop