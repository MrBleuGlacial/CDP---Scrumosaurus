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
      <li class="active"><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/pert') }}"><b>Pert</b> Sprint {{$sprint->number}}</a></li>
      <li><a href="{{ URL::to('/project/'.$project->id. '/sprint/'.$sprint->id . '/burndownchart') }}"><b>BurnDown Chart</b> Sprint {{$sprint->number}}</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('project') }}">Projets</a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/sprint') }}">Sprints</a></li>
        <li><a href="{{ URL::to('project/'.$project->id.'/sprint/'.$sprint->id) }}">Vue d'un Sprint</a></li>
        <li class="active">Pert d'un Sprint</li>
    </ol>
@stop

@section('content')
    <h1 class="page-header">Sprint {{$sprint->number}}</h1>

        <h3 class="page-header">Pert du Sprint {{$sprint->number}}</h3>

        {{ HTML::style('assets/graphics/vis.css') }}
        {{ HTML::script('assets/graphics/vis.js') }}

        <div class="alert alert-info">Si le graphique vous parait étrange, vérifier vos dépendances de tâches. De plus, le graphique sera d'autant plus lisible si vous n'affecter que les dépendances directes ; en effet, si une tâche T3 dépend de T1 et T2, et que T2 dépend déjà de T1, n'affectez que la dépendance T2 à T3.</div>

        <style type="text/css">
        #mynetwork {
          margin:auto;
          width: 1000px;
          height: 800px;
          border: 1px solid lightgray;
        }
        </style>

        <div id="mynetwork"></div>

        <script type="text/javascript">
            //----------------------------INIT----------------------------------//
            //----- Construction de la tâche -----//
              function task(idtmp,dependancetmp,valuetmp, nametmp){
                    this.id = idtmp;
                    this.dependency = dependancetmp;
                    this.value = valuetmp;
                    this.done = 0;
                    this.nextTasks = new Array();
                    this.value1st = valuetmp;
                    this.value2nd = 0;
                    this.name = nametmp;
              };

             //----- Initialisation des données / Remplir avec la BDD -----//

              var listTask = [];

              <?php
                $cpt = 0;
                foreach ($tasks as $key => $value){
                    $cpt++;

                    $dep =  DB::select('select * from depandon where task_id = ?', array($value->id));

                    $depJS = "";
                    $cptdep = 0;
                    foreach($dep as $val){
                        if($cptdep == 0){
                            $depJS = "t".$val->dependance_task_id;
                        } else {
                            $depJS = $depJS . ", t".$val->dependance_task_id;
                        }
                        $cptdep++;
                    }

                    echo 'var t'.$value->id.' = new task('. $cpt . ', ['. $depJS .'], 1, "' . $value->description . '");';
                    echo "\n";
                    echo 'listTask.push(t'.$cpt.');';
                    echo "\n";
                }
              ?>

              var start = [];
              var end = [];

              var tmp_i = 0;
              for(var key in listTask){
                if(listTask[key].dependency == ""){
                    //showTask(listTask[key]);
                    start[tmp_i] = listTask[key];
                    tmp_i += 1;
                }
              }

              //showListTask(start);

              var valueEnd = 0;

              var idMax = listTask.length+1;


             //------------------------------------------------------------------//




            //---------------------------UTILS----------------------------------//
            //----- Affiche la tâche -----//
              function showTask (t){
                document.write("----------------------</br>");
                document.write("Name : " + t.name + "</br>");
                document.write("Id : " + t.id + "</br>");
                document.write("Dependency : ");
                for(var i in t.dependency){
                        document.write(t.dependency[i].id + " ");
                    }
                document.write("</br>");

                document.write("Value : " + t.value + "</br>");
                document.write("Done : " + t.done + "</br>");
                document.write("NextTasks : ");
                for(var i in t.nextTasks){
                    document.write(t.nextTasks[i].id + " ");
                    }
                document.write("</br>");
              }

            //----- Affiche la liste des tâches -----//
              function showListTask (lt){
                for(var key in lt){
                    showTask(lt[key]);
                }
              }
            //-------------------------------------------------------------------//




              //----- Initialisation des sommets -----//

              var nodes = [
                {id: 0, label: 'Start - 0/0', color: "#58FA58"}, //nodes[0]
                {id: idMax, label: 'End', color: "#58FA58"}  //nodes[1]
              ];
              for(var i = 1; i < listTask.length+1; i++){
                nodes.push({id: i, label: String(listTask[i-1].name)});
              }

              //----- Initialisation des arêtes -----//

              var edges = [];
              for(var i in start){
              edges.push({
                        from: 0,
                        to: start[i].id
                      });
              }

              for(var i in listTask){
                for(var j in listTask[i].dependency){
                    edges.push({
                        from: listTask[i].dependency[j].id,
                        to: listTask[i].id
                      });
                    listTask[i].dependency[j].nextTasks.push(listTask[i]);
                }
              }

               var tmp_i = 0;
              for(var key in listTask){
                if(listTask[key].nextTasks == ""){
                    //showTask(listTask[key]);
                    end[tmp_i] = listTask[key];
                    tmp_i += 1;
                }
              }

               for(var i in end){
                edges.push({
                        from: end[i].id,
                        to: idMax
                      });
              }

              //showListTask(listTask);


                      //----- Remplissage du Pert valeur 1 -----//

           function countValue1(ind){
            var nextTmp = listTask[ind].nextTasks;
            if(nextTmp != ""){
                for(var i in nextTmp){
                    var newValue = nextTmp[i].value + listTask[ind].value1st;
                    if(newValue > nextTmp[i].value){
                        //var nodeTmp = nodes[(nextTmp[i].id )+1];
                        //nodeTmp.label = nodeTmp.label + " - " + newValue + "/";
                        nextTmp[i].value1st = newValue;

                        //document.write("newValue : "+ newValue +"</br>");
                    }
                    countValue1((nextTmp[i].id)-1);
                }
            }
            else{
                if(valueEnd < listTask[ind].value1st)
                    //document.write(listTask[ind].value1st);
                    valueEnd = listTask[ind].value1st;
                //document.write("liaison nécessaire</br>");
                }
            }

            function finalizeValue1(){
                nodes[1].label = nodes[1].label + " - " + valueEnd + "/" + valueEnd;
            }

          //Initialisation
            for(var i in start){
            var nodeTmp = nodes[(start[i].id)+1];
            //start[i].value1st = start[i].value;
            nodeTmp.label = nodeTmp.label + " - " + start[i].value1st + "/";
            countValue1((start[i].id)-1);
            }
            finalizeValue1();

            for(var i = (start.length); i < listTask.length; i++){
                var nodeTmp = nodes[(listTask[i].id)+1];
                nodeTmp.label = nodeTmp.label + " - " + listTask[i].value1st + "/";
            }


          //----- Remplissage du Pert valeur 2 -----//

          for(var key in listTask){
            listTask[key].value2nd = valueEnd;
         }

          function countValue2(ind){
            var prvTmp = listTask[ind].dependency;
            if(prvTmp != ""){
                for(var i in prvTmp){
                    var newValue = listTask[ind].value2nd - listTask[ind].value;
                    //document.write(listTask[ind].value2nd + "</br>");
                    //document.write(listTask[ind].value + "</br>");
                    //document.write(newValue + "</br>");
                    if(newValue < prvTmp[i].value2nd){
                        //var nodeTmp = nodes[(prvTmp[i].id )+1];
                        //nodeTmp.label = nodeTmp.label + newValue;//
                        prvTmp[i].value2nd = newValue;
                    }
                    countValue2((prvTmp[i].id)-1);
                }
            }
        }

          for(var i in end){
            var nodeTmp = nodes[(end[i].id)+1];
            nodeTmp.label = nodeTmp.label + valueEnd;
            countValue2((end[i].id)-1);
          }

          for(var i in listTask){
            if(listTask[i].nextTasks != ""){
                var nodeTmp = nodes[(listTask[i].id)+1];
                nodeTmp.label = nodeTmp.label + listTask[i].value2nd;
            }
          }

           //showListTask(listTask);



          //----- Création de l'affichage du Pert -----//
          var container = document.getElementById('mynetwork');
          var data = {
            nodes: nodes,
            edges: edges
          };
          var options = {edges:{style:'arrow-center'}};
          var network = new vis.Network(container, data, options);


</script>



@stop
