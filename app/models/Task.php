<?php


class Task extends Eloquent
{
    protected $table = 'tasks';

    public static function transcriptStatus($value){
        $transcriptedValue = 0;
        switch($value) {
            case 0:
                $transcriptedValue = "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> A faire";
                break;
            case 1:
                $transcriptedValue = "<span class='glyphicon glyphicon-transfer' aria-hidden='true'></span> En cours";
                break;
            case 2:
                $transcriptedValue = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Terminée";
                break;
        }
        return $transcriptedValue;
    }

    public static function transcriptDays($value){
        if($value == 0)
            echo 'Pas terminée/Pas de Sprint';
        else
            echo 'Jour '. $value ;
    }

    public function storeDependance($dependances)
    {
        DB::table('depandon')->where('task_id', $this->id)->delete();
        foreach((array)$dependances as $dependance) {
            DB::table('depandon')->insert(
                array('task_id' => $this->id, 'dependance_task_id' => $dependance)
            );
        }
    }

    public function getDependance($dependances){
        DB::table('depandon')->where('task_id', $this->id)->get();
    }
}