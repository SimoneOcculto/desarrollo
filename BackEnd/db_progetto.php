<?php

    require 'progetto.php';
    require_once 'db_handler.php';

    class db_progetto extends db_handler{

        //dichiarazione attributi
        private $progetto;

        public function __construct() {
            parent::__construct();
        }

        public function register($project){

            $this->progetto = new progetto($project);

            $this->startConnection();

            $sql = "INSERT INTO progetto (Leader, NomeP, DescrizioneP, DataScadenzaP, DataCreazioneP) VALUES ".
                "('".$this->progetto->getLeader()."', '".$this->progetto->getNomeP()."', '".$this->progetto->getDescrizioneP()."', '".$this->progetto->getDataScadenzaP()."', '".$this->progetto->getDataCreazioneP()."')";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        public function getIdUltimoProgetto($leader, $dataCreazione){

            $this->startConnection();

            $sql = "SELECT ID_Progetto 
                    FROM progetto 
                    WHERE (Leader = '".$leader."' AND DataCreazioneP <= '".$dataCreazione."')";

            $result = $this->getConnection()->query($sql);

            $row = $result->fetch_assoc();

            $this->closeconnection();

            return $row['ID_Progetto'];
        }

        public function getArrayProgetti($ricerca){

            $this->startConnection();

            $sql = "SELECT DISTINCT ID_Progetto, NomeP, DescrizioneP, DataScadenzaP, DataCreazioneP FROM progetto WHERE NomeP LIKE '%".$ricerca."%' ORDER BY dataCreazioneP DESC";

            $result = $this->getConnection()->query($sql);

            $array = array();

            $this->closeconnection();

            if($result) {
                if ($result->num_rows == 0) {
                    return false;
                } else {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $project = new progetto($row);
                        $array[] = $project;
                    }
                }
            } else{
                echo "Error in ".$sql."<br>".$this->startConnection()->error;
            }
            return $array;
        }

        public function getAllProgetti(){

            $this->startConnection();

            $sql = "SELECT * FROM progetto ORDER BY ID_Progetto, DataCreazioneP, NomeP, Leader";

            $result = $this->getConnection()->query($sql);

            $array = array();

            $this->closeconnection();

            if($result) {
                if ($result->num_rows == 0) {
                    return false;
                } else {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $project = new progetto($row);
                        $array[] = $project;
                    }
                }
            } else{
                echo "Error in ".$sql."<br>".$this->startConnection()->error;
            }
            return $array;
        }

    }
?>