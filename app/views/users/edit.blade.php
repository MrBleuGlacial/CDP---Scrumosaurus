@extends('layouts.master')

@section('sidebar')
      <ul class="nav nav-sidebar">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
         <li><a href="{{ URL::to('project') }}">Projets</a></li>
      </ul>

    <ul class="nav nav-sidebar">
      <li class="active"><a href="{{ URL::to('/users/'.Auth::user()->id) }}">Mon Profil</a></li>
    </ul>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Accueil</a></li>
        <li><a href="{{ URL::to('/users/'.Auth::user()->id) }}">Mon Profil</a></li>
        <li class="active">Editer mon profil</li>
    </ol>
@stop

@section('content')
   <div class="container-fluid">
           <div class="row">
             <div class="col-md-12">
                @if(!$errors->first() == "")
                 <div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
                @endif

            {{ Form::model($user, array('route' => 'users.update', 'method' => 'PUT')) }}
                    <div class="form-group">
                            {{ Form::label('email', 'E-Mail') }}
                            {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                            {{ Form::label('name', 'Nom') }}
                            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                            {{ Form::label('lastname', 'Prénom') }}
                            {{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                            {{ Form::label('password', 'Mot de Passe') }}
                            {{ Form::password('password', array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                            {{ Form::label('confirmpassword', 'Confirmer mot de passe') }}
                            {{ Form::password('confirmpassword', array('class' => 'form-control')) }}
                    </div>

                  <button type="submit" class="btn btn-primary">Modifier le profil</button>
                <!--</form>-->
                {{ Form::close() }}
             </div>
           </div>
         </div>
@stop