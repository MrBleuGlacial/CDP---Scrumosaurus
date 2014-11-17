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
        $sprints = Sprint::all();
        $project = Project::find($projectId);

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
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
