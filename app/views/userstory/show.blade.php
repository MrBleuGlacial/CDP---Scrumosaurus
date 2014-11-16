@extends('layouts.master')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li><a href="{{ URL::to('project/'.$project->id) }}">{{ $project->name }}</a></li>
        <li class="active">{{ $userstory->name }}</li>
    </ol>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 col-md-4 ">
                <dl class="dl-horizontal">
                    <dt>Nom</dt>
                    <dd>{{ $project->name }}</dd>
                    <dt>Description</dt>
                    <dd>{{ $project->description }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Commencé il y a</dt>
                    <dd>
                    </dd>
                </dl>
            </div>
            <div class="col-sm-5 col-md-5">
                <p>

                </p>
            </div>
        </div>
    </div>

    <p>

    </p>

@stop
