<?php

require 'C:/xampp/htdocs/desarrollo/Model/task.php';

class db_task extends db_handler{

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

        $sql = "SELECT DISTINCT * FROM task WHERE ID_task=".$ricerca.";";

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

    public function UpdateTask($project){

        $this->task = new task($project);

        $this->startConnection();

        $sql = "SELECT nomeT FROM task WHERE ID_Task=".$this->task->getId_task().";";

        $nomeT=$this->getConnection()->query($sql);
        $row = $nomeT->fetch_assoc();

        if(strcmp($row['nomeT'],$this->task->getNomeT()!=0)){
            $cambioN="UPDATE task SET NomeT='".$this->task->getNomeT()."' WHERE ID_task=".$this->task->getId_task().";";
            $this->getConnection()->query($cambioN);
        }

        $sql = "SELECT DescrizioneT FROM task WHERE ID_task=".$this->task->getId_task();

        $DescrizioneT=$this->getConnection()->query($sql);
        $row = $DescrizioneT->fetch_assoc();

        if(strcmp($row['DescrizioneT'],$this->task->getDescrizioneT()!=0)){
            $cambioD="UPDATE task SET DescrizioneT='".$this->task->getDescrizioneT()."' WHERE ID_Task=".$this->task->getId_task().";";
            $this->getConnection()->query($cambioD);
        }


        $sql = "SELECT DataScadenzaT FROM task WHERE ID_Task=".$this->task->getId_task();

        $dataScadenzaT=$this->getConnection()->query($sql);
        $row = $dataScadenzaT->fetch_assoc();

        $dataScadenzaT=strtotime($row['DataScadenzaT']);
        $dataT=strtotime($this->task->getDataScadenzaT());


        if($dataScadenzaT!=$dataT){
            $cambioData="UPDATE task SET DataScadenzaT='".$this->task->getDataScadenzaT()."' WHERE ID_task=".$this->task->getId_task().";";
            $this->getConnection()->query($cambioData);
        }

        $sql = "SELECT Priorita FROM task WHERE ID_Task=".$this->task->getId_task();

        $Priorita=$this->getConnection()->query($sql);
        $row = $Priorita->fetch_assoc();

        if($Priorita!=$row['Priorita']){
            $cambioP="UPDATE task SET Priorita='".$this->task->getPriorita()."' WHERE ID_task=".$this->task->getId_task().";";
            $this->getConnection()->query($cambioP);
        }

        $this->closeconnection();
    }

    public function MoveTask($idProgetto, $task){

        $this->startConnection();

        $sql = "UPDATE task SET Progetto = '".$idProgetto."' WHERE ID_Task = '".$task."';";

        $this->getConnection()->query($sql);

        $this->closeconnection();
    }

}
?>