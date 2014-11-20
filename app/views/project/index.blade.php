    @extends('layouts.master')

    @section('sidebar')
          <ul class="nav nav-sidebar">
                <li><a href="{{ URL::to('/') }}">Accueil</a></li>
                <li class="active"><a href="{{ URL::to('project') }}">Projets</a></li>
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
        <a href="/project/create" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Enregistrer un Projet</a>
        <br/>
        <br/>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Nom du projet</td>
                    <td>Description</td>
                    <td>Date de début</td>
                    <td>Date de fin</td>
                    <td style="width:180px">Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach($project as $key => $value)
                <tr>
                    <td><a href="{{ URL::to('/project/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->name }}</a></td>
                    <td><a href="{{ URL::to('/project/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->description }}</a></td>
                    <td><a href="{{ URL::to('/project/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->start }}</a></td>
                    <td><a href="{{ URL::to('/project/'.$value->id) }}" style="display:block;width:100%;height:100%;cursor:pointer;">{{ $value->end }}</a></td>

                    <td style="width:180px">
                        <a class="btn btn-sm btn-info" href="{{ URL::to('project/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
                        {{ Form::open(array('url' => 'project/' . $value->id, 'class' => 'pull-right')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
                        {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>




    @stop
