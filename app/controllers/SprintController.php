<?php

class SprintController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($projectId)
	{
        $project = Project::find($projectId);
        $sprints = DB::table('sprints')->where('project_id', $projectId)->get();

		return View::Make('sprint.index')->with(array('sprints' => $sprints, 'project' => $project));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($projectId)
	{
        $project = Project::find($projectId);
        return View::make('sprint.create')
            ->with('project', $project);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($projectId)
	{
        $rules = array(
            'number'       => 'required',
            'duration'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$projectId.'/sprint/create')
                ->withErrors($validator);
        } else {
            $sprint = new Sprint();
            $sprint->number = Input::get('number');
            $sprint->project_id = $projectId;
            $sprint->duration = Input::get('duration');
            $sprint->begin = Input::get('begin');
            $sprint->end = Input::get('end');
            $sprint->save();

            Session::flash('message', 'Sprint créé avec succès!');
            return Redirect::to('project/' . $projectId. '/sprint');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($idProject, $idSprint)
	{
        $project = Project::find($idProject);
        $sprint = Sprint::find($idSprint);
        $userStoriesAvailable = UserStory::where('project_id', '=', $idProject)->where('sprint_id', '=', 0)->get();
        $userStoriesOfSprint = UserStory::where('sprint_id', '=', $idSprint)->get();
        return View::make('sprint.show')
            ->with(Array(
                'sprint'=> $sprint,
                'project' => $project,
                'userStoriesAvailable' => $userStoriesAvailable,
                'userStoriesOfSprint' => $userStoriesOfSprint));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($idProject, $idSprint)
	{
        $project = Project::find($idProject);
        $sprint = Sprint::find($idSprint);
        return View::make('sprint.edit')
            ->with(array('sprint' => $sprint, 'project' => $project ));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($idProject, $idSprint)
	{
        $rules = array(
            'number'    => 'required',
            'duration'  => 'required',
            'begin'     => 'required',
            'end'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$idProject.'/sprint/'.$idSprint.'/edit')
                ->withErrors($validator);
        } else {
            $sprint = Sprint::find($idSprint);
            $sprint->number = Input::get('number');
            $sprint->project_id = $idProject;
            $sprint->duration = Input::get('duration');
            $sprint->begin = Input::get('begin');
            $sprint->end = Input::get('end');
            $sprint->save();

            Session::flash('message', 'Sprint mis à jour avec succès!');
            return Redirect::to('project/' . $idProject. '/sprint');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idProject, $idSprint)
	{
            // delete
            $sprint = Sprint::find($idSprint);
            $sprint->delete();

            // redirect
            Session::flash('message', 'Sprint supprimé avec succés !');
            return Redirect::to('project/' . $idProject . '/sprint');
	}

    public function addUserStory($idProject, $idSprint, $idUS){
        $userstory = UserStory::find($idUS);
        $userstory->sprint_id = $idSprint;
        $userstory->save();

        return Redirect::to('project/' . $idProject. '/sprint/' .$idSprint);
    }

    public function deleteUserStory($idProject, $idSprint, $idUS){
        $userstory = UserStory::find($idUS);
        $userstory->sprint_id = 0;
        $userstory->save();

        return Redirect::to('project/' . $idProject. '/sprint/' .$idSprint);
    }


}
