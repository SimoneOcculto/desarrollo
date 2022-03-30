<?php

    class utente{
        //Dichiarazione attributi
        private $mail;
        private $password;
        private $nome;
        private $cognome;
        private $nascita;

        //Definizione Metodi
        public function __construct($array){
            $this->mail = $array['Mail'];
            $this->password = $array['Password'];
            $this->nome = $array['Nome'];
            $this->cognome = $array['Cognome'];
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

    }

?>