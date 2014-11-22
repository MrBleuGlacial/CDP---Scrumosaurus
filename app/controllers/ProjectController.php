<?php

class ProjectController extends BaseController {

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
        $user = User::find(Auth::user()->id);
        $projects = $user->projects;

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
        $project->git = Input::get('git');
        $project->save();

        $user = User::find(Auth::user()->id);
        $user->projects()->attach($project->id);
        DB::table('workingon')
            ->where(array('project_id' => $project->id, 'user_id' => Auth::user()->id))
            ->update(array('position_id' => 0));

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
        //$userstories = UserStory::where('project_id', 'LIKE', $id)->get();

        $project = Project::find($id);

        $contributors = $project->users;
        $workingon = DB::table('workingon')->where('project_id', $id)->get();



        $userPositions = array();

        foreach($workingon as $key => $value){
          $userPositions[$value->user_id] = $value->position_id;
        }



        return View::make('project.show')
            ->with(Array(
                'project' => $project,
                'idProject' => $id,
                'contributors' => $contributors,
                'userPositions' => $userPositions));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $project = Project::find($id);

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
        $project->git = Input::get('git');
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
        $user = User::find(Auth::user()->id);
        $user->projects()->detach($project->id);
        $project->delete();

        // redirect
        Session::flash('message', 'Projet correctement effacé !');
        return Redirect::to('project');
	}


    public function addUser($idProject){
        $rules = array(
            'login' => 'required',
        );

        $messages = array(
            'required' => "Le champ :attribute est requis.",
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        $userId = 0;
        // process the login
        if ($validator->fails()) {
            return Redirect::to('/project/'.$idProject)
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            if(sizeof(User::where('login','=', Input::get('login'))->get()) == 0){
                return Redirect::to('/project/'.$idProject)->withErrors("Cet identifiant utilisateur n'existe pas.");
            } else {
                $userId = User::where('login','=',Input::get('login'))->pluck('id');
            }

            if(sizeof(DB::table('workingon')->where(array('user_id' => $userId, 'project_id' => $idProject, 'position_id' => Input::get('rank')))->get()) > 0){
                return Redirect::to('/project/'.$idProject)->withErrors("Vous ne pouvez pas ajouter deux fois le même utilisateur");
            }
            else {
                DB::table('workingon')->insert(
                    array('user_id' => $userId, 'project_id' => $idProject, 'position_id' => Input::get('rank'))
                );

                // redirect
                Session::flash('message', 'Ce contributeur a bien été ajouté.');
                return Redirect::to('/project/'.$idProject);
            }
        }
    }
}
