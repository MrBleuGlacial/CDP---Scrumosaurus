 @extends('layouts.master')

 @section('sidebar')
    <ul class="nav nav-sidebar">
        <li><a href=""><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li class="active"><a href="/project">Projets</a></li>
    </ul>
 @stop

 @section('content')
          <h1>Création de Projet</h1>
    <!--
    <form action='/project/store' method="POST" name="formulaireProjet">
       Nom du projet : <input type="text" name="projectName" class="form-control"/> <br/> <br/>
       Description du projet : <textarea name="projectDescription" class="form-control"></textarea> <br/> <br/>

            echo'Date de début de projet :';
            $timetmp = date('d-m-Y');
            echo'<input type="text" name="projectBirthDay" value=" '.$timetmp.'" class="form-control"/> <br/>';
            echo'Date de fin de projet :';
            echo'<input type="text" name="projectEndDay" value=" '.$timetmp.'" class="form-control"/> <br/>';

        <input type="submit" name="Valider" value="Valider">
    </form>
    -->

    {{ Form::open(array('url' => 'project')) }}

    <div class="form-group">
            {{ Form::label('name', 'Nom du projet') }}
            {{ Form::text('name', Input::old('projectName'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('start', 'Date de début') }}
            {{ Form::text('start', Input::old('projectBirthDay'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('end', 'Date de fin') }}
            {{ Form::text('end', Input::old('projectEndDay'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('git', 'Lien du GitHub') }}
            {{ Form::text('git', Input::old('projectGit'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Créer le projet !', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

 @stop