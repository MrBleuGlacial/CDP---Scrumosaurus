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
                @if(!$errors->first() == "")
                 <div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
                @endif

             {{ Form::open(array('url' => '/users')) }}
                <!--<form role="form">-->
                  <div class="form-group">
                    <span class="glyphicon glyphicon-user"></span>  <label for="inputLogin">Identifiant</label>
                    <input type="text" class="form-control" name="inputLogin" placeholder="Entrez votre identifiant">
                  </div>
                  <div class="form-group">
                    <span class="glyphicon glyphicon-envelope"></span>  <label for="inputEMail">E-Mail</label>
                    <input type="email" class="form-control" name="inputEmail" placeholder="Entrez votre email">
                  </div>
                  <div class="form-group">
                    <span class="glyphicon glyphicon-th-list"></span> <label for="inputLastName">Nom</label>
                    <input type="text" class="form-control" name="inputLastName" placeholder="Entrez votre nom">
                  </div>
                  <div class="form-group">
                    <span class="glyphicon glyphicon-th-list"></span> <label for="inputName">Prénom</label>
                    <input type="text" class="form-control" name="inputName" placeholder="Entrez votre prénom">
                  </div>
                  <div class="form-group">
                    <span class="glyphicon glyphicon-asterisk"></span> <label for="inputPassword">Mot de passe</label>
                    <input type="password" class="form-control" name="inputPassword" placeholder="Entrez votre mot de passe">
                  </div>
                    <div class="form-group">
                      <span class="glyphicon glyphicon-asterisk"></span> <label for="inputConfirmPassword">Confirmer votre mot de passe</label>
                      <input type="password" class="form-control" name="inputConfirmPassword" placeholder="Confirmez votre mot de passe">
                    </div>
                  <button type="submit" class="btn btn-primary">S'inscrire</button>
                <!--</form>-->
                {{ Form::close() }}
             </div>
           </div>
         </div>
@stop

<?php

   // $user = new User;

    //$user->USER_LOGIN = 'meycheni';
    //$user->USER_PASSWORD= 'cdp';
    //$user->USER_NAME = 'Maxime';
    //$user->USER_SURNAME = 'Eychenié';
    //$user->USER_EMAIL = 'meycheni@cdp.com';


    //$user->save();

?>