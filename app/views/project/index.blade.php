    @extends('layouts.master')

    @section('sidebar')
          <ul class="nav nav-sidebar">
                <li><a href="/">Accueil</a></li>
                <li class="active"><a href="/project">Projets</a></li>
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
        <a href="/project/create" class="btn btn-sm btn-default glyphicon glyphicon-floppy-disk">  Enregistrer un Projet</a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nom</td>
                    <td>Description</td>
                    <td>Début</td>
                    <td>Fin</td>
                </tr>
            </thead>
            <tbody>
            @foreach($project as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->start }}</td>
                    <td>{{ $value->end }}</td>
                    <!-- we will also add show, edit, and delete buttons -->

                    <td>
                    <a class="btn btn-small btn-info" href="{{ URL::to('project/' . $value->id . '/edit') }}">Modifier</a>
                    {{ Form::open(array('url' => 'project/' . $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Supprimer', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>




    @stop
