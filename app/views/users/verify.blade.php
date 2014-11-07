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
              <li><a href="/register">S'inscrire</a></li>
              <li class="active">Vérification</li>
            </ol>
        @stop

    @section('content')
             <h1 class="page-header">Inscription</h1>

             <?php //echo $_POST('inputLogin'); ?>
    @stop