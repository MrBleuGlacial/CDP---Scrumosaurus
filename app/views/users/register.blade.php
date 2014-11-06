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
              <li class="active">S'inscrire</li>
            </ol>
        @stop

    @section('content')
             <h1 class="page-header">S'inscrire</h1>

             <div class="container-fluid">
               <div class="row">
                 <div class="col-md-12">
                 {{ Form::open(array('url' => '/register')) }}
                    <!--<form role="form">-->
                      <div class="form-group">
                        <span class="glyphicon glyphicon-user"></span>  <label for="inputLogin">Identifiant</label>
                        <input type="email" class="form-control" id="inputLogin" placeholder="Entrez votre identifiant">
                      </div>
                      <div class="form-group">
                        <span class="glyphicon glyphicon-envelope"></span>  <label for="inputEMail">E-Mail</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Entrez votre email">
                      </div>
                      <div class="form-group">
                        <span class="glyphicon glyphicon-th-list"></span> <label for="inputName">Nom</label>
                        <input type="email" class="form-control" id="inputName" placeholder="Entrez votre nom">
                      </div>
                      <div class="form-group">
                        <span class="glyphicon glyphicon-th-list"></span> <label for="inputFirstName">Prénom</label>
                        <input type="email" class="form-control" id="inputFirstName" placeholder="Entrez votre prénom">
                      </div>
                      <div class="form-group">
                        <span class="glyphicon glyphicon-asterisk"></span> <label for="inputPassword">Mot de passe</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Entrez votre mot de passe">
                      </div>
                        <div class="form-group">
                          <span class="glyphicon glyphicon-asterisk"></span> <label for="inputConfirmPassword">Confirmer votre mot de passe</label>
                          <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirmez votre mot de passe">
                        </div>
                      <button type="submit" class="btn btn-primary">S'inscrire</button>
                    <!--</form>-->
                    {{ Form::close() }}
                 </div>
               </div>
             </div>
    @stop