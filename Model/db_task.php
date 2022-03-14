<?php

require 'Controller/task.php';

class db_task extends  db_handler{

    //dichiarazione attributi
    private $task;

    public function __construct() {
        parent::__construct();
    }

    public function register($project_task){
        $this->task = new task($project_task);

        $this->startConnection();

        $sql = "INSERT INTO task (Progetto, NomeT, DescrizioneT, DataScadenzaT, DataCreazioneT, Priorita) VALUES ".
            "('".$this->task->getId_progetto()."', '".$this->task->getNomeT()."', '".$this->task->getDescrizioneT()."', '".$this->task->getDataScadenzaT()."', '".$this->task->getDataCreazioneT()."', '".$this->task->getPriorita()."')";

        $this->getConnection()->query($sql);

        $this->closeconnection();
    }

    public function EliminaTask($id){

        $this->startConnection();

        $sql = "DELETE FROM task WHERE Progetto=".$id;

        $this->getConnection()->query($sql);

        $this->closeconnection();
    }

}


?>