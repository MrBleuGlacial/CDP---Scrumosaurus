<?php

class TaskController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = Task::all();

        return View::make('task.index')
            ->with('task', $tasks);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('task.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $task = new Task;
        $task->description = Input::get('description');
        $task->difficulty = Input::get('difficulty');
        $task->done = Input::get('done');
        $task->save();

        Session::flash('message', 'Votre tâche a été créée! Bon courage !');
        return Redirect::to('task');
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
    public function edit($id)
    {
        // get the nerd
        $task = Task::find($id);

        // show the edit form and pass the nerd
        return View::make('task.edit')
            ->with('task', $task);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $task = Task::find($id);
        $task->description = Input::get('description');
        $task->difficulty = Input::get('difficulty');
        $task->done = Input::get('done');
        $task->save();

        Session::flash('message', 'Votre tâche a été mise à jour !');
        return Redirect::to('task');
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
