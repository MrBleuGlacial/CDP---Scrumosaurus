 @extends('layouts.master')

 @section('breadcrumb')
     <ol class="breadcrumb">
         <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
         <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
         <li><a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id) }}">{{ $userstory->name }}</a></li>
         <li class="active">Création d'une tâche</li>
     </ol>
 @stop

 @section('content')
    <h1>Création de Tâches</h1>

    {{ HTML::ul($errors->all()) }}
    {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/task')) }}

    <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('difficulty', 'Difficulté') }}
            {{ Form::text('difficulty', Input::old('difficulty'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('dependances', 'Dépendances') }}
        <select multiple="multiple" class="form-control" name="dependances[]">
            @foreach($tasks as $aKey => $task)
                <option value="{{$task->id}}">{{ $task->description }}</option>
            @endforeach
        </select>
    </div>

    {{ Form::submit('Créer la tâche', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

 @stop