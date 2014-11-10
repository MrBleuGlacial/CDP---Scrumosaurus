<?php
    $userstories = UserStory::where('project_id', 'LIKE', $idproject)->get();
?>

<h1>UserStories</h1>
<a href="{{ URL::to('userstory/create') }}">+ ajouter une UserStory</a>
<table class="table table-striped table-bordered">
 <thead>
     <tr>
         <td>#</td>
         <td>Description</td>
         <td>Priorité</td>
         <td>Difficulté</td>
         <td>Action</td>
     </tr>
 </thead>
 <tbody>
 @foreach($userstories as $key => $value)
     <tr>
         <td>{{ $value->id }}</td>
         <td>{{ $value->description }}</td>
         <td>{{ $value->priority }}</td>
         <td>{{ $value->difficulty }}</td>
         <td>
            <a href="{{ URL::to('userstory/'.$value->id . '/edit') }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> <span class="sr-only">Editer</span></a>
            {{ Form::open(array('url' => 'userstory/' . $value->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Supprimer', array('class' => 'btn btn-default')) }}
            {{ Form::close() }}
         </td>
     </tr>
 @endforeach
 </tbody>
</table>