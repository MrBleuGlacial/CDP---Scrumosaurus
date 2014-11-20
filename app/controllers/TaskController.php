<?php

class TaskController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($projectId)
    {
        $project = Project::find($projectId);
        $tasks = Task::all();

        return View::make('task.index')
            ->with(array('task' => $tasks, 'project' => $project));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($projectId)
    {
        $project = Project::find($projectId);
        return View::make('task.create')
            ->with('project', $project);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($idProject)
    {
        $task = new Task;
        $task->description = Input::get('description');
        $task->difficulty = Input::get('difficulty');
        if(Input::get('done') == null)
            $task->done = 0;
        else
            $task->done = 1;
        $task->save();

        Session::flash('message', 'Votre tâche a été créée! Bon courage !');
        return Redirect::to('project/' . $idProject . '/task');
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
    public function edit($idProject, $idTask)
    {
        $project = Project::find($idProject);
        $task = Task::find($idTask);

        return View::make('task.edit')
            ->with(array('task' => $task, 'project' => $project));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($idProject, $idTask)
    {
        $task = Task::find($idTask);
        $task->description = Input::get('description');
        $task->difficulty = Input::get('difficulty');
        $task->done = Input::get('done');
        $task->save();

        Session::flash('message', 'Votre tâche a été mise à jour !');
        return Redirect::to('project/' . $idProject. '/task');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idProject, $idTask)
    {
        // delete
        $task = Task::find($idTask);
        $task->delete();

        // redirect
        Session::flash('message', 'Tâche correctement effacée !');
        return Redirect::to('project/' . $idProject. '/task');
    }


}
