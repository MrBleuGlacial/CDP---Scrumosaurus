    @extends('layouts.master')

    @section('sidebar')
          <ul class="nav nav-sidebar">
                <li><a href="/">Accueil</a></li>
                <li class="active"><a href="/task">Tâches</a></li>
          </ul>
    @stop

        @section('breadcrumb')
            <ol class="breadcrumb">
                <li><a href="/">Accueil</a></li>
                <li><a href="/project">Projets</a></li>
                <li class="active">Tâches</li>
            </ol>
        @stop

    @section('content')
        <h1 class="page-header">Tâches</h1>
        <a href="/task/create" class="btn btn-sm btn-primary glyphicon glyphicon-floppy-disk"> Enregistrer une tâche</a>
        <br/>
        <br/>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Description</td>
                    <td>Difficulté</td>
                    <td>Terminée</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($task as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->difficulty }}</td>
                    <td>{{ $value->done }}</td>
                    <!-- we will also add show, edit, and delete buttons -->

                    <td>
                    <a class="btn btn-small btn-info" href="{{ URL::to('task/' . $value->id . '/edit') }}">Modifier</a>
                    {{ Form::open(array('url' => 'task/' . $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>




    @stop
