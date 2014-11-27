<?php

class UserStoryController extends \BaseController {

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
        //$userstories = UserStory::all();
        $project = Project::find($projectId);
        $userstories = DB::table('userstories')->where('project_id', $projectId)->get();

        return View::make('userstory.index')
            ->with(array('userstories' => $userstories, 'project' => $project));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($idProject)
	{
        if(UserStory::canCreateNewOne($idProject)){
            $project = Project::find($idProject);
            return View::make('userstory.create')
                ->with('project', $project);
        }
        else{
            return Redirect::to("/");
        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($idProject)
	{
        $rules = array(
            'number'            => 'required',
            'description'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$idProject.'/userstory/create')
                ->withErrors($validator);
        } else {
            $userstory = new UserStory();
            $userstory->number = Input::get('number');
            $userstory->project_id = $idProject;
            $userstory->description = Input::get('description');
            $userstory->priority = Input::get('priority');
            $userstory->difficulty = Input::get('difficulty');
            $userstory->save();

            Session::flash('message', 'UserStory créée avec succés!');
            return Redirect::to('project/' . $idProject . '/userstory');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($idProject, $idUserStory)
	{
        $project = Project::find($idProject);
        $userstory = UserStory::find($idUserStory);
        $tasks = Task::where('userstory_id', '=', $idUserStory)->get();

        $contributors = $project->users;
        $nameContributors = array();

        foreach($contributors as $value){
            $nameContributors[$value->id] = $value->login . " - " . $value->name . " " . $value->lastname;
        }

        return View::make('userstory.show')
            ->with(Array(
                'userstory'=> $userstory,
                'project' => $project,
                'tasks' => $tasks,
                'nameContributors' => $nameContributors));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($idProject, $idUserStory)
	{
        if(UserStory::canEdit($idProject, $idUserStory)){
            $project = Project::find($idProject);
            $userstory = UserStory::find($idUserStory);
            return View::make('userstory.edit')
                ->with(array('userstory' => $userstory, 'project' => $project ));
        }
        else{
            return Redirect::to("/");
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($projectId, $idUserStory)
	{
        $rules = array(
            'number'            => 'required',
            'description'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$projectId.'/userstory/'.$idUserStory.'/edit')
                ->withErrors($validator);
        } else {
            $userstory = UserStory::find($idUserStory);
            $userstory->number = Input::get('number');
            $userstory->description = Input::get('description');
            $userstory->priority = Input::get('priority');
            $userstory->difficulty = Input::get('difficulty');
            $userstory->save();

            // redirect
            Session::flash('message', 'UserStory mise à jour avec succès !');
            return Redirect::to('project/' . $projectId . '/userstory');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($projectId, $idUserStory)
    {
        // delete
        $userstory = UserStory::find($idUserStory);
        $userstory->delete();

        // redirect
        Session::flash('message', 'UserStory supprimée avec succés !');
        return Redirect::to('project/' . $projectId . '/userstory');
	}
}
