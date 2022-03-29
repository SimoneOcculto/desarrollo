<?php

    class utente
    {
        //Dichiarazione attributi
        private $mail;
        private $password;
        private $nome;
        private $cognome;
        private $nascita;

        //Definizione Metodi
        public function __construct($array){
            $this->mail = $array['mail'];
            $this->password = $array['password'];
            $this->nome = $array['nome'];
            $this->cognome = $array['cognome'];
            if(array_key_exists('nascita', $array))
                $this->nascita = $array['nascita'];
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