<?php

    class partecipazione{
        //Dichiarazione Attributi
        private $Invitante;
        private $Invitato;
        private $Progetto;
        private $Stato;

        //Definizione Metodi
        public function __construct($array){
            $this->Invitante = $array['Invitante'];
            $this->Invitato = $array['Invitato'];
            $this->Progetto = $array['Progetto'];
            $this->Stato = $array['Stato'];
        }

        public function getInvitante(){
            return $this->Invitante;
        }

        public function getInvitato(){
            return $this->Invitato;
        }

        public function getProgetto(){
            return $this->Progetto;
        }

        public function getStato(){
            return $this->Stato;
        }
    }

?>