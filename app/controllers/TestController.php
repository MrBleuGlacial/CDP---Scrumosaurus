<?php

class TestController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($idproject, $iduserstory)
    {
        $tests = Test::where('userstory_id', '=', $iduserstory)->get();
        $project = Project::find($idproject);
        $userstory = UserStory::find($iduserstory);

        return View::make('test.index')
            ->with(Array(
                'tests' => $tests,
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
        $tests = Task::all();
        $project = Project::find($idproject);
        $userstory = UserStory::find($iduserstory);
        return View::make('test.create')
            ->with(Array(
                'tasks' => $tests,
                'project' => $project,
                'userstory' => $userstory
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
            'description'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('project/'.$idproject.'/userstory/'.$iduserstory.'/test/create')
                ->withErrors($validator);
        } else {
            $test = new Test;
            $test->description = Input::get('description');
            $test->userstory_id = $iduserstory;
            $test->save();

            Session::flash('message', 'Votre test a été ajouté! Bon courage !');
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
        $test = Test::find($id);
        return View::make('test.show')
            ->with(Array(
                'task' => $test,
                'idTest' => $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idProject, $idUserStory, $idTest)
    {
        // get the nerd
        $test = Test::find($idTest);
        $project = Project::find($idProject);
        $userStory = UserStory::find($idUserStory);

        // show the edit form and pass the nerd
        return View::make('test.edit')
            ->with(Array(
                'test'=> $test,
                'project'=>$project,
                'userstory'=>$userStory));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($idProject, $idUserStory, $idTest)
    {
        $test = Test::find($idTest);
        $test->description = Input::get('description');
        $test->user_id = Auth::user()->id;
        $test->result = Input::get('result');
        $test->userstory_id = $idUserStory;
        $test->works = Input::get('works');
        $test->date = \Carbon\Carbon::now();
        $test->save();

        Session::flash('message', 'Votre test a été mise à jour !');
        return Redirect::to('project/'.$idProject."/userstory/".$idUserStory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idProject, $idUserStory, $idTest)
    {
        // delete
        $task = Test::find($idTest);
        $task->delete();

        // redirect
        Session::flash('message', 'Test correctement effacée !');
        return Redirect::to('project/'.$idProject."/userstory/".$idUserStory);
    }
}
