<?php

    class utente{
        //Dichiarazione attributi
        private $mail;
        private $password;
        private $nome;
        private $cognome;
        private $nascita;
        private $ruolo;

        //Definizione Metodi
        public function __construct($array){
            $this->mail = $array['Mail'];
            $this->password = $array['Password'];
            $this->nome = $array['Nome'];
            $this->cognome = $array['Cognome'];
            $this->ruolo = $array['Ruolo'];
            if(array_key_exists('Nascita', $array))
                $this->nascita = $array['Nascita'];
        }

        public function getMail(){
            return $this->mail;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getCognome(){
            return $this->cognome;
        }

        public function getNascita(){
            return $this->nascita;
        }

        public function getRuolo(){
            return $this->ruolo;
        }

    }

?>