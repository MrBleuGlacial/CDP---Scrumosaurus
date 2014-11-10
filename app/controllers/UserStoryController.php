<?php

class UserStoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
        $idproject = 0;
        $userstories = UserStory::where('project_id', 'LIKE', $idproject)->get();

        return View::make('userstory.index')->with('userstories', $userstories);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('userstory.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // store
        $userstory = new UserStory();
        $userstory->name = Input::get('name');
        $userstory->description = Input::get('description');
        $userstory->priority = Input::get('priority');
        $userstory->difficulty = Input::get('difficulty');
        $userstory->save();

        // redirect
        Session::flash('message', 'UserStory créée avec succés!');
        return Redirect::to('userstory');
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
        echo $id;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $userstory = UserStory::find($id);
        return View::make('userstory.edit')
            ->with('userstory', $userstory);
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
