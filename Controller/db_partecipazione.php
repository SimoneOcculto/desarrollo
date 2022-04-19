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

        public function RicercaInvitiRicevutiUtente($mail){

            $this->startConnection();

            $sql = "SELECT * FROM partecipazione WHERE Invitato = '".$mail."';";

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
    }

?>