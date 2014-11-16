<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 10/11/2014
 * Time: 16:48
 */


class Project extends Eloquent
{
    protected $table="projects";

    public static function getMyProjects(){
        return Project::where('id', 'NOT LIKE', -1)->get();
    }

    function canAccess(){
        if(Auth::check()) {

        }
        else
            return false;
    }
}