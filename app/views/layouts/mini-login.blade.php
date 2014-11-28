<ul class="nav navbar-nav navbar-right">
    <li><a href="/users/create">S'inscrire</a></li>
    <li class="dropdown" id="menuLogin">
       <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Se connecter</a>
       <div class="dropdown-menu" style="padding:17px; width: 300px;">
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
                 <br/>
                 <div>Pas de compte? <a href="/users/create">Créez en un maintenant !</a></div>
        </div>
     </li>
</ul>