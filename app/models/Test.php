<?php


class Test extends Eloquent
{
    protected $table = 'tests';
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