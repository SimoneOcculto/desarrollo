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

            $sql = "SELECT Invitante FROM partecipazione";

            $mail1=$this->getConnection()->query($sql);
            $row = $mail1->fetch_assoc();

            if(strcmp($row['Invitante'],$this->partecipazione->getInvitante()!=0)){

            }

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









    }

?>