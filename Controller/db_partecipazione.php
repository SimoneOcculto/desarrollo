<?php

    require 'C:/xampp/htdocs/desarrollo/Model/partecipazione.php';

    class db_partecipazione extends db_handler{
        //dichiarazione attributi
        private $progetto;

        public function __construct() {
            parent::__construct();
        }

        public function NewRelazione($relazione){

            $this->partecipazione = new partecipazione($relazione);

            $this->startConnection();

            $sql = "INSERT INTO partecipazione (Invitante, Invitato, Progetto, Stato) VALUES ".
                "('".$this->partecipazione->getInvitante()."', '".$this->partecipazione->getInvitato()."', '".$this->partecipazione->getProgetto()."', '".$this->partecipazione->getStato()."')";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        public function ControlloPK($oggetto){

            $this->partecipazione = new partecipazione($relazione);

            $this->startConnection();

            $sql = "SELECT Invitante FROM partecipazione";

            $mail1=$this->getConnection()->query($sql);
            $row = $mail1->fetch_assoc();

            if(strcmp($row['Invitante'],$this->partecipazione->getInvitante()!=0)){

            }

        }

        public function RicercaInvitiInSospesoRicevutiUtente($mail){

            $this->startConnection();

            $sql = "SELECT * FROM partecipazione WHERE Invitato = '".$mail."' AND Stato = 1;";

            $result = $this->getConnection()->query($sql);

            $array = array();

            $this->closeconnection();

            if($result) {
                if ($result->num_rows == 0) {
                    return false;
                } else {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $relation = new partecipazione($row);
                        $array[] = $relation;
                    }
                }
            } else{
                echo "Error in ".$sql."<br>".$this->startConnection()->error;
            }

            return $array;
        }

        public function AccettaRifiutoInvito($num, $progetto, $mail){

            $this->startConnection();

            if($num == 0){
                $sql = "UPDATE Partecipazione SET Stato = 2 WHERE Progetto = '".$progetto."' AND Invitato = '".$mail."';";
            } else{
                $sql = "UPDATE Partecipazione SET Stato = 3 WHERE Progetto = '".$progetto."' AND Invitato = '".$mail."';";
            }

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }
    }
?>