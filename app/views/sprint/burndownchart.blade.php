@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id) }}">Projet <b>{{$project->name}}</b></a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/userstory') }}">Backlog</a></li>
      <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
      <li><a href="{{ $project->git }}">Lien GitHub</a></li>
    </ul>

    <ul class="nav nav-sidebar">
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/kanban') }}"><b>Kanban</b> Sprint {{$sprint->number}}</a></li>
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/pert') }}"><b>Pert</b> Sprint {{$sprint->number}}</a></li>
      <li class="active"><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/burndownchart') }}"><b>BurnDown Chart</b> Sprint {{$sprint->number}}</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/sprint/'.$sprint->id) }}">Vue d'un Sprint</a></li>
        <li class="active">BurnDown Chart d'un Sprint</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Sprint {{$sprint->number}}</h1>

        <h3 class="page-header">BurnDown Chart du Sprint {{$sprint->number}}</h3>

        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">
                google.load("visualization", "1", {packages:["corechart"]});
                google.setOnLoadCallback(drawChart);

                var valRf = <?php echo json_encode($tt );?> ;

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Day', 'Référence', 'Réel'],
                        ['Jour 0', valRf[0], valRf[0]]
                        ]);

                        for(var i = 1; i < valRf.length; i++){
                            data.addRow(['Jour '+ i, valRf[0]-(valRf[0]/(valRf.length-1)*i), valRf[i]]);
                        }
                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                    chart.draw(data);
              }
            </script>
            <div id="chart_div" style="margin:auto; width: auto; height: 500px;"></div>

        <br/>
@stop
