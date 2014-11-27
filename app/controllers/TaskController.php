<?php

class TaskController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($idproject, $iduserstory)
    {
        $tasks = Task::all();
        $project = Project::find($idproject);
        $userstory = UserStory::find($iduserstory);

        return View::make('userstory.show')
            ->with(Array(
                'tasks' => $tasks,
                'project' => $project,
                'userstory' => $userstory
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($idproject, $iduserstory)
    {
        $project = Project::find($idproject);
        $userstory = UserStory::find($iduserstory);
        $tasks =  DB::select('select tasks.* from tasks join userstories u on tasks.userstory_id = u.id join projects p on u.project_id = p.id where p.id = ? ', array($idproject) );
        $contributors = $project->users;
        $nameContributors = array();
        $daysOfSprint = array();

        foreach($contributors as $value){
            $nameContributors[$value->id] = $value->login . " - " . $value->name . " " . $value->lastname;
        }

        if($userstory->sprint_id == "0"){
            $daysOfSprint[0] = "Pas de Sprint rattaché";
        } else {
            $daysOfSprint[0] = "Pas terminée";
            $sprint = Sprint::find($userstory->sprint_id);

            for($i = 1; $i <= $sprint->duration; $i++)
            $daysOfSprint[$i] = "Jour " . $i;
        }

        return View::make('task.create')
            ->with(Array(
                'tasks' => $tasks,
                'project' => $project,
                'userstory' => $userstory,
                'nameContributors' => $nameContributors,
                'daysOfSprint' => $daysOfSprint,
            ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($idproject, $iduserstory)
    {
        $rules = array(
            'description'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$idproject.'/userstory/'.$iduserstory.'/task/create')
                ->withErrors($validator);
        } else {
            $task = new Task;
            $task->description = Input::get('description');
            $task->user_id = Input::get('developer');
            $task->status = Input::get('status');
            $task->dayfinished = Input::get('dayfinished');
            $task->userstory_id = $iduserstory;
            $task->save();

            $task->storeDependance(Input::get('dependances'));

            Session::flash('message', 'Votre tâche a été créée! Bon courage !');
            return Redirect::to('project/'.$idproject.'/userstory/'.$iduserstory);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $userstories = UserStory::where('task_id', 'LIKE', $id)->get();

        $task = Task::find($id);
        return View::make('task.show')
            ->with(Array(
                'task' => $task,
                'idTask' => $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idProject, $idUserStory, $idTask)
    {
        $task = Task::find($idTask);
        $project = Project::find($idProject);
        $userStory = UserStory::find($idUserStory);
        $tasks =  DB::select('select tasks.* from tasks join userstories u on tasks.userstory_id = u.id join projects p on u.project_id = p.id where p.id = ? ', array($idProject) );
        $contributors = $project->users;
        $nameContributors = array();
        $daysOfSprint = array();

        foreach($contributors as $value){
            $nameContributors[$value->id] = $value->login . " - " . $value->name . " " . $value->lastname;
        }

        if($userStory->sprint_id == "0"){
            $daysOfSprint[0] = "Pas de Sprint rattaché";
        } else {
            $daysOfSprint[0] = "Pas terminée";
            $sprint = Sprint::find($userStory->sprint_id);

            for($i = 1; $i <= $sprint->duration; $i++)
                $daysOfSprint[$i] = "Jour " . $i;
        }

        // show the edit form and pass the nerd
        return View::make('task.edit')
            ->with(Array(
                'task'=> $task,
                'tasks'=>$tasks,
                'project'=>$project,
                'userstory'=>$userStory,
                'nameContributors' => $nameContributors,
                'daysOfSprint' => $daysOfSprint));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($idProject, $idUserStory, $idTask)
    {
        $task = Task::find($idTask);
        $task->description = Input::get('description');
        $task->user_id = Input::get('developer');
        $task->status = Input::get('status');
        $task->dayfinished = Input::get('dayfinished');
        $task->save();

        $task->storeDependance(Input::get('dependances'));

        Session::flash('message', 'Votre tâche a été mise à jour !');
        return Redirect::to('project/'.$idProject."/userstory/".$idUserStory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $task = Task::find($id);
        $task->delete();

        // redirect
        Session::flash('message', 'Tâche correctement effacée !');
        return Redirect::to('task');
    }
}
