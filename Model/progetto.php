<?php

    class progetto{
        //Dichiarazione Attributi
        private $ID_Progetto;
        private $Leader;
        private $NomeP;
        private $DescrizioneP;
        private $DataScadenzaP;
        private $DataCreazioneP;

        //Definizione Metodi
        public function __construct($array){
            if(array_key_exists('ID_Progetto', $array))
                $this->ID_Progetto = $array['ID_Progetto'];
            if (!empty($array['Leader'])) {
                $this->Leader = $array['Leader'];
            }
            $this->NomeP = $array['NomeP'];
            $this->DescrizioneP = $array['DescrizioneP'];
            $this->DataScadenzaP = $array['DataScadenzaP'];
            $this->DataCreazioneP = $array['DataCreazioneP'];
        }

        public function getId(){
            return $this->ID_Progetto;
        }

        public function getLeader(){
            return $this->Leader;
        }

        public function getNomeP(){
            return $this->NomeP;
        }

        public function getDescrizioneP(){
            return $this->DescrizioneP;
        }

        public function getDataScadenzaP(){
            return $this->DataScadenzaP;
        }

        public function getDataCreazioneP(){
            return $this->DataCreazioneP;
        }
    }

?>