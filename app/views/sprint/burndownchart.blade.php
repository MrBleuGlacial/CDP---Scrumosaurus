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
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/kanban') }}">Kanban Sprint {{$sprint->number}}</a></li>
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

        {{ HTML::style('assets/graphics/vis.css') }}
        {{ HTML::script('assets/graphics/vis.js') }}

          <style type="text/css">
            body, html {
              font-family: sans-serif;
            }
          </style>


        <div id="visualization"></div>

        <script type="text/javascript">

            //NT: date, valueRl & valueRef doivent être de même taille.

            //----- INITIALISATION DES 2 COURBES -----//

            var names = ['Référence', 'Réel'];

            var groups = new vis.DataSet();

            groups.add({
                id: 0,
                content: names[0],
                options: {
                    drawPoints: {
                        style: 'circle' // square, circle
                    },
                    shaded: {
                        orientation: 'bottom' // top, bottom
                    }
                }});

            groups.add({
                id: 1,
                content: names[1],
                options: {
                    drawPoints: {
                        style: 'circle' // square, circle
                    },
                    shaded: {
                        orientation: 'bottom' // top, bottom
                    }
                }});


                //----- ENREGISTREMENT DES VALEURS -----//

            //-A REMPLIR AVEC LA BDD-//
            var date = ['2014-06-11','2014-06-12','2014-06-13','2014-06-14','2014-06-15','2014-06-16'];
            var valueRef = [50,40,30,20,10,0];
            var valueRl = [30,50,15,15,15,5];
            //-----------------------//

            var evolve = 0;
            var valueMax = 0;

            var items = [];

            for(var key in valueRef){
                valueMax += valueRef[key];
                //document.write(valueMax + "</br>");
            }

                //----- CREATION DU MODELE BURNDOWNCHART -----//

            function create(){
            //---Init Référence ---//
                for(var key in date){
                    evolve += valueRef[key];
                    var tmp = valueMax - evolve;
                    //document.write(tmp + "</br>");
                    items.push({x: date[key], y: tmp, group: 0});
                }
            //--- Init Réelle ---//
                evolve = 0;
                for(var key in date){
                    evolve += valueRl[key];
                    var tmp = valueMax - evolve;
                    //document.write(evolve + "</br>");
                    items.push({x: date[key], y: tmp, group: 1});
                }
                document.write("Coût restant : " + (valueMax - evolve));
            }

            create();

                //----- CREATION DE LA VUE BURNDOWNCHART -----//

          var container = document.getElementById('visualization');
          var dataset = new vis.DataSet(items);

          var options = {
            defaultGroup: 'ungrouped',
            legend: true,
            start: '2014-06-11',
            end: '2014-06-16'
          };

          var graph2d = new vis.Graph2d(container, dataset, groups,options);

        </script>
<br/>
@stop
