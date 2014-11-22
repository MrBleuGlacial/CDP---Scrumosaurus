<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    use UserTrait, RemindableTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function projects()
    {
        return $this->belongsToMany('Project', 'workingon', 'user_id', 'project_id');
    }

    public static function transcriptPosition($position){
        $transcriptedValue = "";

        switch($position) {
            case 0:
                $transcriptedValue = "Product Owner";
                break;
            case 1:
                $transcriptedValue = "Scrum Master";
                break;
            case 2:
                $transcriptedValue = "Développeur";
                break;
            default:
                $transcriptedValue = "Pas de rang";
        }

        return $transcriptedValue;
    }

}
