@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li class="active"><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li class="active">{{ $project->name }}</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Détail du projet {{$project->name;}}</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="well">
                <div class="container">
                    <dl class="dl-horizontal">
                        <dt>Nom</dt>
                        <dd>{{ $project->name }}</dd>
                        <dt>Description</dt>
                        <dd>{{ $project->description }}</dd>

                        <dt>Commencé depuis</dt>
                        <dd>
                            <?php
                             // Set timezone
                              date_default_timezone_set("UTC");

                              // Time format is UNIX timestamp or
                              // PHP strtotime compatible strings
                              function dateDiff($time1, $time2, $precision = 6) {
                                // If not numeric then convert texts to unix timestamps
                                if (!is_int($time1)) {
                                  $time1 = strtotime($time1);
                                }
                                if (!is_int($time2)) {
                                  $time2 = strtotime($time2);
                                }

                                // If time1 is bigger than time2
                                // Then swap time1 and time2
                                if ($time1 > $time2) {
                                  $ttime = $time1;
                                  $time1 = $time2;
                                  $time2 = $ttime;
                                }

                                // Set up intervals and diffs arrays
                                $intervals = array('year','month','day','hour','minute');
                                $diffs = array();

                                // Loop thru all intervals
                                foreach ($intervals as $interval) {
                                  // Create temp time from time1 and interval
                                  $ttime = strtotime('+1 ' . $interval, $time1);
                                  // Set initial values
                                  $add = 1;
                                  $looped = 0;
                                  // Loop until temp time is smaller than time2
                                  while ($time2 >= $ttime) {
                                    // Create new temp time from time1 and interval
                                    $add++;
                                    $ttime = strtotime("+" . $add . " " . $interval, $time1);
                                    $looped++;
                                  }

                                  $time1 = strtotime("+" . $looped . " " . $interval, $time1);
                                  $diffs[$interval] = $looped;
                                }

                                $count = 0;
                                $times = array();
                                // Loop thru all diffs
                                foreach ($diffs as $interval => $value) {
                                  // Break if we have needed precission
                                  if ($count >= $precision) {
                                break;
                                  }
                                  // Add value and interval
                                  // if value is bigger than 0
                                  if ($value > 0) {
                                // Add s if value is not 1
                                if ($value != 1) {
                                  $interval .= "s";
                                }
                                // Add value and interval to times array
                                $times[] = $value . " " . $interval;
                                $count++;
                                  }
                                }

                                // Return string with times
                                return implode(", ", $times);
                              }

                            echo dateDiff("now", $project->start);
                            ?>
                        </dd>
                    </dl>
                </div>
            </div> <!-- WELL -->
            <div>

            <h2 class="page-header">Contributeurs</h2>

            @if(!$errors->first() == "")
             <div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
            @endif

             @if (Session::has('message'))
             <div class="alert alert-success">{{ Session::get('message') }}</div>
             @endif

            <div class="col-md-6">
                {{ Form::open(array('url' => 'project/' . $project->id . '/add', 'class' => "form-inline")) }}
                <div class="form-group">
                    {{ Form::text('login', Input::old('login'), array('class' => 'form-control', 'placeholder' => 'Entrez un identifiant')) }}
                     {{ Form::select('rank', array('Product Owner', 'Scrum Master', 'Développeur'), Input::old('rank'), array('class' => 'form-control')) }}
                    {{ Form::submit('Ajouter un contributeur', array('class' => 'btn btn-primary')) }}
                </div>
                <div class="form-group">
                {{ Form::close() }}
                </div>
            </div>

            <br/>
            <br/>
            <br/>

            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Identifiant</td>
                                <td>Rang</td>
                                <td style="width:60px">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $cpt = 0; ?>
                        @foreach($contributors as $key => $value)
                            <?php $cpt++;?>
                            <tr>
                                <td>{{ $value->name }} {{$value->lastname}}</td>
                                <td>{{ $value->login }}</td>
                                <td>{{ User::transcriptPosition($userPositions[$value->id]) }}</td>

                                <td style="width:60px">
                                {{ Form::open(array('url' => 'project/' . $project->id. '/delete/'. $value->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('nbContributors', $cpt) }}
                                        {{ Form::submit('Supprimer', array('class' => 'btn btn-sm btn-warning')) }}
                                {{ Form::close() }}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div> <!-- USERS -->
        </div> <!-- ROW -->
    </div> <!-- CONTAINER-FLUID -->
@stop
