<?php

require 'C:/xampp/htdocs/desarrollo/Controller/task.php';
require_once 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

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

    public function EliminaSingleTask($id){

        $this->startConnection();

        $sql = "DELETE FROM task WHERE ID_Task=".$id;

        $this->getConnection()->query($sql);

        $this->closeconnection();
    }

    public function getAllTask($progetto){

        $this->startConnection();

        $sql = "SELECT * FROM task WHERE Progetto=".$progetto." ORDER BY ID_Task, Progetto, NomeT, DataScadenzaT";

        $result = $this->getConnection()->query($sql);

        $array = array();

        $this->closeconnection();

        if($result) {
            if ($result->num_rows == 0) {
                return false;
            } else {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $taskt = new task($row);
                    $array[] = $taskt;
                }
            }
        } else{
            echo "Error in ".$sql."<br>".$this->startConnection()->error;
        }
        return $array;
    }

    public function getArrayTask($ricerca){

        $this->startConnection();

        $sql = "SELECT DISTINCT Progetto, ID_Task, NomeT, DescrizioneT, DataScadenzaT, DataCreazioneT FROM task WHERE ID_task=".$ricerca;

        $result = $this->getConnection()->query($sql);

        $array = array();

        $this->closeconnection();

        if($result) {
            if ($result->num_rows == 0) {
                return false;
            } else {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $taskt = new task($row);
                    $array[] = $taskt;
                }
            }
        } else{
            echo "Error in ".$sql."<br>".$this->startConnection()->error;
        }
        return $array;
    }

}

?>


?>