<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 11/11/14
 * Time: 16:33
 */

class LoginController extends \BaseController {

    public function index(){
        return View::make("login/index");
    }

    public function post(){
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'login'      => 'required',
            'password'   => 'required',
        );

        $messages = array(
            'required' => "Le champ :attribute est requis.",
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $user = array(
                'login' => Input::get('login'),
                'password' => Input::get('password'),
            );

            if (Auth::attempt($user)) {
                // redirect
                Session::flash('message', 'Vous êtes bien connecté.');
                return Redirect::to('project');
            }

            Session::flash('messageError', 'Connexion échoué. Mauvais identifiants?');
            return Redirect::to('login');
        }
    }
} 