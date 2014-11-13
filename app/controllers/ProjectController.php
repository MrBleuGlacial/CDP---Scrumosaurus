<?php

class ProjectController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $projects = Project::all();

        return View::make('project.index')
            ->with('project', $projects);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('project.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $project = new Project;
        $project->name = Input::get('name');
        $project->description = Input::get('description');
        $project->start = Input::get('start');
        $project->end = Input::get('end');
        $project->save();

        Session::flash('message', 'Votre projet a été créé! Bon courage !');
        return Redirect::to('project');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        // get the nerd
        //$project = Project::find($id);

        // show the view and pass the nerd to it
        //return View::make('project.show')
        //    ->with('project', $project);
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
        $project = Project::find($id);

        // show the edit form and pass the nerd
        return View::make('project.edit')
            ->with('project', $project);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $project = Project::find($id);
        $project->name = Input::get('name');
        $project->description = Input::get('description');
        $project->start = Input::get('start');
        $project->end = Input::get('end');
        $project->save();

        Session::flash('message', 'Votre projet a été mis à jour !');
        return Redirect::to('project');
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
        $project = Project::find($id);
        $project->delete();

        // redirect
        Session::flash('message', 'Projet correctement effacé !');
        return Redirect::to('project');
	}


}
