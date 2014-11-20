<?php


class Task extends Eloquent
{
    protected $table = 'tasks';

    public static function transcriptDifficulty($value){
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

    public static function transcriptDone($value){
        if($value == 0)
            echo '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
        else
            echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
    }
}