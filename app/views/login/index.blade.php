@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li class="active"><a href="{{ URL::to('login') }}">Se connecter</a></li>
      </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
       <li><a href="{{ URL::to('/') }}">Accueil</a></li>
       <li class="active">Se connecter</li>
    </ol>
 @stop

@section('content')
     <h1 class="page-header">Se connecter</h1>

     <div class="container-fluid">
       <div class="row">
         <div class="col-md-12">

         @if (Session::has('messageError'))
         <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
         @endif

         @if (Session::has('message'))
         <div class="alert alert-success">{{ Session::get('message') }}</div>
         @endif


         @if(!$errors->first() == "")
          <div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
         @endif

         @if (!Session::has('message'))
         {{ Form::open(array('url' => '/login')) }}
              <div class="form-group">
                <label for="login">Identifiant</label>
                <input type="text" class="form-control" name="login" placeholder="Entrez votre login">
              </div>
              <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe">
              </div>
              <button type="submit" class="btn btn-primary">Se connecter</button>
         {{ Form::close() }}
         @endif

         <br/>
         <div>Pas de compte? <a href="{{ URL::to('users/create') }}">Créez en un maintenant !</a></div>
          </div>
        </div>
      </div>
@stop