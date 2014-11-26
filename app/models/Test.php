<?php


class Test extends Eloquent
{
    var $testeur;

    public function testeur()
    {
        $user = User::find($this->user_id);
        if(empty($user))
            return;
        else
            return $user->login;
    }
}