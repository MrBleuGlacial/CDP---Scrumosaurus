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

    public static function transcriptPriorityOrDifficulty($value){
        $transcriptedValue = 0;

        switch($value) {
            case 0:
                $transcriptedValue = 1;
                break;
            case 1:
                $transcriptedValue = 2;
                break;
            case 2:
                $transcriptedValue = 3;
                break;
            case 3:
                $transcriptedValue = 5;
                break;
            case 4:
                $transcriptedValue = 8;
                break;
        }

        return $transcriptedValue;
    }
} 