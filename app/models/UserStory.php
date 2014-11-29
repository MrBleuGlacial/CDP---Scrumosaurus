<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 11/9/2014
 * Time: 7:09 PM
 */

class UserStory extends Eloquent {

    protected $table = 'userstories';

    /**
     * @return bool
     */
    public static function canCreateNewOne($idProject){
        if(Auth::check()) {
            //TODO tester si workingOn
            return true;
        }
        return false;
    }

    public static function canEdit($idProject, $idUserStory){
        if(Auth::check()) { // Pas necessaire avec le blocage de route
            $userstory = UserStory::find($idUserStory);
            if(!empty($userstory) && $userstory->project_id == $idProject){
                //TODO tester si workingOn
                return true;
            }
        }
        return false;
    }
} 