<?php

class UserController extends BaseController {


    public function showRegister()
    {
        return View::make('users/register');
    }
}
