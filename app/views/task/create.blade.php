 @extends('layouts.master')

 @section('sidebar')
    <ul class="nav nav-sidebar">
        <li><a href=""><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li class="active"><a href="/task">Tâches</a></li>
    </ul>
 @stop

 @section('content')
          <h1>Création de Tâches</h1>
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

    {{ Form::open(array('url' => 'task')) }}

    <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('difficulty', 'Difficulté') }}
            {{ Form::text('difficulty', Input::old('difficulty'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('done', 'Terminée (0 ou 1)') }}
            {{ Form::text('done', Input::old('done'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Créer la tâche', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

 @stop