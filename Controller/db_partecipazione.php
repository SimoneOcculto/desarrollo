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

        public function ControlloMail($mInvitante,$mInvitato){

            $this->startConnection();

            $sql = "SELECT Invitante, Invitato FROM partecipazione";

            $mail1=$this->getConnection()->query($sql);
            $row = $mail1->fetch_assoc();

            if(strcmp($row['Invitante'],$mInvitante)==0){

                if(strcmp($row['Invitato'],$mInvitato)!=0){
                    return true;
                }else
                {
                    return false;
                }

            }else{
                return true;
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

        public function RicercaInvitiInSospesoInviatiUtente($mail){

            $this->startConnection();

            $sql = "SELECT * FROM partecipazione WHERE Invitante = '".$mail."' AND Stato = 1;";

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

            switch($num){
                case 0:
                    $sql = "UPDATE Partecipazione SET Stato = 2 WHERE Progetto = '".$progetto."' AND Invitato = '".$mail."';";
                    break;

                case 1:
                    $sql = "UPDATE Partecipazione SET Stato = 3 WHERE Progetto = '".$progetto."' AND Invitato = '".$mail."';";
                    break;
            }

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        public function RevocaInvito($progetto, $mInvitante, $mInvitato){

            $this->startConnection();

            $sql = "DELETE FROM Partecipazione WHERE Progetto = '".$progetto."' AND Invitato = '".$mInvitato."' AND Invitante = '".$mInvitante."';";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

    }
?>