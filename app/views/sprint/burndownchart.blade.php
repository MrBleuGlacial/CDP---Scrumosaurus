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

        	  //-----INIT WITH BDD-----//
        	  var name = "Burndown Chart";

        	  <?php
        	  $totalCost = 0;
        	  foreach($userstories as $key => $value){
                $totalCost += $value->difficulty;
        	  }

        	  ?>

        	  var valRf = [<?php echo $totalCost; ?>,18,16,10,5,0]; //Valeurs de référence, 1ère valeur correspond au total de début
        	  var valDay = [3,2,6,5,5]; //Coût effectué pour chaque jour
        	  //-----------------------//

        	  var indCost = valRf[0];
        	  var indDay = 0;

        	  function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Day', 'Référence', 'Réel'],
                  ['Jour '+indDay, valRf[0], valRf[0] ]
                ]);

                indDay += 1;

        		for(var i = 1; i < valRf.length; i++){
        			indCost -= valDay[i-1];
        			data.addRow(['Jour '+indDay, valRf[i], indCost]);
        			indDay += 1;
        		}
        		//items.push({x: date[key], y: tmp, group: 0});


                var options = {
                  title: name,
        		  curveType: 'function',
        		  pointSize : 5,
        		  pointShape : "diamond",
        		  legend: { position: 'bottom'}
                };

                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                chart.draw(data, options);
              }
            </script>

            <div id="chart_div" style="margin:auto; width: auto; height: 500px;"></div>

        <br/>
@stop
