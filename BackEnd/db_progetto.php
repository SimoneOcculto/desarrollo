<?php

    require 'progetto.php';
    //require 'db_handler.php';

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

        public function search_id($mail, $data_creazione){

            $this->startConnection();

            $sql = "SELECT ID_Progetto FROM progetto WHERE Leader LIKE '".$mail."' AND dataCreazioneP = '".$data_creazione."' ORDER BY id DESC";

            $result = $this->getConnection()->query($sql);

            $row = $result->fetch_assoc();

            $this->closeconnection();

            return $row['id'];
        }

        public function delete($id){

            $this->startConnection();

            $sql = "DELETE FROM progetto WHERE ID_Progetto = \"".$id."\"";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        //UPDATE QUERIES
        public function updateid($oldid, $newid){

            $this->startConnection();

            $sql = "UPDATE progetto SET ID_Progetto = '".$newid."' WHERE ID_Progetto LIKE '".$oldid."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateLeader($id, $newLeader){

            $this->startConnection();

            $sql = "UPDATE progetto SET Leader = '".$newLeader."' WHERE ID_Progetto LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateNome($id, $newNome){

            $this->startConnection();

            $sql = "UPDATE progetto SET NomeP = '".$newNome."' WHERE ID_Progetto LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateDescrizione($id, $newDescrizione){

            $this->startConnection();

            $sql = "UPDATE progetto SET DescrizioneP = '".$newDescrizione."' WHERE ID_Progetto LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateData_scadenza($id, $newData_scadenza){

            $this->startConnection();

            $sql = "UPDATE progetto SET DataScadenzaP = '".$newData_scadenza."' WHERE ID_Progetto LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        /*public function updateData_creazione($id, $newData_creazione){

            $this->startConnection();

            $sql = "UPDATE progetto SET Data_creazione = '".$newData_creazione."' WHERE id LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updateds
            }

            $this->closeconnection();
        }

        public function updateCandidatura($id, $newCandidatura){

            $this->startConnection();

            $sql = "UPDATE progetto SET Candidatura = '".$newCandidatura."' WHERE id LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateNumero_candidati($id, $newNumero_candidati){

            $this->startConnection();

            $sql = "UPDATE progetto SET Numero_candidati = '".$newNumero_candidati."' WHERE id LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateRicercabile($id, $newRicercabile){

            $this->startConnection();

            $sql = "UPDATE utente SET Ricercabile = '".$newRicercabile."' WHERE id LIKE '".$id."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }*/
        //END UPDATE QUERIES

        public function setProgetto($id){

            $this->startConnection();

            $sql = "SELECT * FROM progetto WHERE ID_Progetto = '".$id."'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if ($result->num_rows == 1) {
                // output data of each row
                $row = $result->fetch_assoc();

                $progetto = new progetto($row);

                return $progetto;
            } else {
                return null;
            }

        }

        public function getMyProgetti($mail){

            $this->startConnection();

            $sql = "SELECT * FROM progetto WHERE Leader = '".$mail."'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if ($result->num_rows >= 1) {
                // output data of each row
                return $result;

            } else {
                return null;
            }
        }

        public function getProgetto(){
            return $this->progetto;
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

    }
?>