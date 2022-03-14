<?php

    require 'Controller/progetto.php';
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
                    WHERE (Leader = '".$leader."' AND DataCreazioneP <= '".$dataCreazione."')
                    ORDER BY ID_Progetto DESC";

            $result = $this->getConnection()->query($sql);

            $row = $result->fetch_assoc();

            $this->closeconnection();

            return $row['ID_Progetto'];
        }

        public function getArrayProgetti($ricerca){

            $this->startConnection();

            $sql = "SELECT DISTINCT Leader, ID_Progetto, NomeP, DescrizioneP, DataScadenzaP, DataCreazioneP FROM progetto WHERE (ID_Progetto LIKE '%".$ricerca."%' OR NomeP LIKE '%".$ricerca."%') ORDER BY dataCreazioneP DESC";

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

        public function EliminaProgetto($id){

            $this->startConnection();

            $sql = "DELETE FROM progetto WHERE ID_Progetto=".$id;

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        public function getNomeProg($id){

            $this->startConnection();

            $sql = "SELECT NomeP FROM progetto WHERE ID_Progetto=".$id;

            $result=$this->getConnection()->query($sql);

            $this->closeconnection();

            return $result;
        }

        public function UpdateProg($project){

            $leader;
            $nomeP;
            $DescrizioneP;
            $dataScadenzaP;

            $this->progetto = new progetto($project);

            $this->startConnection();

            $sql = "SELECT Leader FROM progetto WHERE ID_Progetto=".$this->progetto->getId();

            $leader=$this->getConnection()->query($sql);

            if(strcmp($leader,$this->progetto->getLeader())!=0){
                $cambioL="UPDATE progetto SET Leader=".$this->progetto->getLeader()." WHERE ID_Progetto=".$this->progetto->getId();
                $this->getConnection()->query($cambioL);
            }

            $sql = "SELECT nomeP FROM progetto WHERE ID_Progetto=".$this->progetto->getId();

            $nomeP=$this->getConnection()->query($sql);

            if(strcmp($nomeP,$this->progetto->getNomeP())!=0){
                $cambioN="UPDATE progetto SET NomeP=".$this->progetto->getNomeP()." WHERE ID_Progetto=".$this->progetto->getId();
                $this->getConnection()->query($cambioN);
            }

            $sql = "SELECT DescrizioneP FROM progetto WHERE ID_Progetto=".$this->progetto->getId();

            $DescrizioneP=$this->getConnection()->query($sql);

            if(strcmp($DescrizioneP,$this->progetto->getDescrizioneP())!=0){
                $cambioD="UPDATE progetto SET DescrizioneP=".$this->progetto->getDescrizioneP()." WHERE ID_Progetto=".$this->progetto->getId();
                $this->getConnection()->query($cambioD);
            }

            $sql = "SELECT DataScadenzaP FROM progetto WHERE ID_Progetto=".$this->progetto->getId();

            $dataScadenzaP=$this->getConnection()->query($sql);

            $dataScadenzaP=strtotime($dataScadenzaP);
            $dataP=strtotime($this->progetto->getDataScadenzaP());

            if($dataScadenzaP!=$dataP)
            {
                $cambioData="UPDATE progetto SET DataScadenzaP=".$this->progetto->getDataScadenzaP()." WHERE ID_Progetto=".$this->progetto->getId();
                $this->getConnection()->query($cambioData);
            }

            $this->closeconnection();

        }

    }
?>