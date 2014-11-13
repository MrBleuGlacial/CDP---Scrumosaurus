<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Session::has('message'))
		    return View::make('users/index');
        else
            return Redirect::to('users/create');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('users/create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'inputName'       => 'required',
            'inputLastName'   => 'required',
            'inputEmail'      => 'required|email',
            'inputLogin'      => 'required',
            'inputPassword'   => 'required',
            'inputConfirmPassword' => 'required',
            "inputConfirmPassword" => 'same:inputPassword'
        );

        $messages = array(
            'required' => "Le champ :attribute est requis.",
            'same' => "Les deux mots de passe doivent être identiques",
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('inputPassword', 'inputConfirmPassword'));
        } else {
            // store
            $user = new User;
            $user->login      = Input::get('inputLogin');
            $user->email      = Input::get('inputEmail');
            $user->password   = Hash::Make(Input::get('inputPassword'));
            $user->name       = Input::get('inputName');
            $user->lastname   = Input::get('inputLastName');

            if(sizeof(User::where('login','=',Input::get('inputLogin'))->get()) > 0){
                return Redirect::to('users/create')->withErrors("Ce nom d'utilisateur existe deja");
            } else {
                $user->save();

                // redirect
                Session::flash('message', 'Votre compte a bien été créé.');
                return Redirect::to('/users');
            }
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
