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
    public function index()
    {
        $userstories = UserStory::all();

        return View::make('userstory.index')
            ->with('userstory', $userstories);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($idProject)
	{
        if(Userstory::canCreateNewOne($idProject)){
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
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$idProject.'/userstory/create')
                ->withErrors($validator);
        } else {
            $userstory = new UserStory();
            $userstory->name = Input::get('name');
            $userstory->project_id = $idProject;
            $userstory->description = Input::get('description');
            $userstory->priority = Input::get('priority');
            $userstory->difficulty = Input::get('difficulty');
            $userstory->save();

            Session::flash('message', 'UserStory créée avec succés!');
            return Redirect::to('project/' . $idProject);
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
        return View::make('userstory.show')
            ->with(Array(
                'userstory'=> $userstory,
                'project' => $project));
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
            $userstory = UserStory::find($id);
            return View::make('userstory.edit')
                ->with('userstory', $userstory);
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
	public function update($id)
	{
        $userstory = UserStory::find($id);
        $userstory->name = Input::get('name');
        $userstory->description = Input::get('description');
        $userstory->priority = Input::get('priority');
        $userstory->difficulty = Input::get('difficulty');
        $userstory->save();

        // redirect
        Session::flash('message', 'UserStory mis à jours avec succés !');
        return Redirect::to('userstory');
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
        $userstory = UserStory::find($id);
        $userstory->delete();

        // redirect
        Session::flash('message', 'UserStory supprimée avec succés !');
        return Redirect::to('userstory');
	}
}
