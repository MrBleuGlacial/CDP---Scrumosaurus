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

    public function isDone($day){
        // PAS DE TACHE DANS L'US
        $tasks = DB::table('tasks')
            ->where('userstory_id', '=', $this->id)->get();
        if(empty($tasks)){
            return true;
        }

        // TACHE NON FINI
        $tasks = DB::table('tasks')
            ->where('userstory_id', '=', $this->id)
            ->where('dayfinished', '<=', $day)->get();
        foreach($tasks as $t){
            if($t->status != 2)
                return false;
        }

        // TACHE PAS ENCORE PASSE
        $tasks = DB::table('tasks')
            ->where('userstory_id', '=', $this->id)
            ->where('dayfinished', '>', $day)->get();
        return empty($tasks);
    }
}