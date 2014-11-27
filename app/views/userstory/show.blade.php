@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li class="active"><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}"> {{ $project->name }} </a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}"> Backlog</a></li>
        <li class="active">Vue d'une User Story</li>
    </ol>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <h1 class="page-header">User Story {{$userstory->number}}</h1>

            <a href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/task/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter une tâche</a>
                    <br/>
                    <br/>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>Développeur</td>
                                <td>Description</td>
                                <td>Statut</td>
                                <td>Terminée le</td>
                                <td>Dépendance(s) (Déroulez pour voir)</td>
                                <td style="width:180px">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $key => $value)
                            <?php $dep =  DB::select('select * from depandon where task_id = ?', array($value->id)); ?>
                            <?php
                                $tasksDependances = array();
                                foreach($dep as $val){
                                    $tasksDependances[] = Task::find($val->dependance_task_id);
                                }
                            ?>
                            <tr>
                                <td>{{ $nameContributors[$value->user_id] }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ Task::transcriptStatus($value->status) }}</td>
                                <td>{{ Task::transcriptDays($value->dayfinished) }}</td>
                                <td><select>@foreach($tasksDependances as $aKey => $task)
                                       <option value="{{$task->id}}">{{ $task->description }}</option>
                                    @endforeach </select></td>

                                <td style="width:180px">
                                <a class="btn btn-sm btn-info" href="{{ URL::to('project/'.$project->id.'/userstory/'.$userstory->id.'/task/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
                                {{ Form::open(array('url' => 'project/'.$project->id.'/userstory/'.$userstory->id.'/task/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
                                {{ Form::close() }}
                                </td>
                              </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
           </div>

@stop
