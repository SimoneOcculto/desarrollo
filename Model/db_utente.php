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

            $sql = "INSERT INTO utente (Mail, Password, Nome, Cognome) VALUES ".
                "('".$this->utente->getMail()."', '".$this->utente->getPassword()."', '".$this->utente->getNome()."', '".$this->utente->getCognome()."')";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        //Controllo che l'email sia presente nel database
        public function checkUtente($mail){

            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE Mail LIKE '".$mail."'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if($result->num_rows == 1) {
                // output data of each row
                return false;
            }else{
                return true;
            }
        }
    }

?>