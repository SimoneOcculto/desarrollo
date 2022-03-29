<?php

    require 'C:/xampp/htdocs/desarrollo/Controller/utente.php';
    require_once 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    class db_utente extends db_handler{
        //dichiarazione attributi
        private $utente;

        public function __construct() {
            parent::__construct();
        }

        public function register($user){

            $this->utente = new utente($user);

            $this->startConnection();

            $sql = "INSERT INTO utente (mail, password, nome, cognome) VALUES ".
                "('".$this->utente->getMail()."', '".$this->utente->getPassword()."', '".$this->utente->getNome()."', '".$this->utente->getCognome()."', '".$this->utente->getDescrizione()."')";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }
    }

?>