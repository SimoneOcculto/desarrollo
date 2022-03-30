<?php

    require 'C:/xampp/htdocs/desarrollo/Controller/utente.php';
    require_once 'C:/xampp/htdocs/desarrollo/Model/db_handler.php';

    class db_utente extends db_handler{
        //dichiarazione attributi
        private $utente;

        public function __construct()
        {
            parent::__construct();
        }

        public function register($user)
        {

            $this->utente = new utente($user);

            $this->startConnection();

            $sql = "INSERT INTO utente (Mail, Password, Nome, Cognome) VALUES " .
                "('" . $this->utente->getMail() . "', '" . $this->utente->getPassword() . "', '" . $this->utente->getNome() . "', '" . $this->utente->getCognome() . "')";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        //Controllo che l'email sia presente nel database
        public function checkUtente($mail)
        {

            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE Mail LIKE '" . $mail . "'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if ($result->num_rows == 1) {
                // output data of each row
                return false;
            } else {
                return true;
            }
        }

        public function accesso_utente($mail, $password)
        {

            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE Mail LIKE '" . $mail . "' AND Password LIKE '" . $password . "'";

            $result = $this->getConnection()->query($sql);

            $conta = mysqli_num_rows($result);

            $this->closeconnection();

            if ($result->num_rows == 1 && $mail != '' && $password != '') {
                $row = $result->fetch_assoc();
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];
                $_SESSION['mail'] = $row['mail'];
                return true;
            } else {
                return false;

            }
        }

        public function getUtente($mail){

            $this->startConnection();

            $sql = "SELECT Nome, Cognome, Mail, Password  FROM utente WHERE Mail='".$mail."'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if($result) {
                if ($result->num_rows == 0) {
                    return false;
                } else{
                    $row = $result->fetch_assoc();
                    $user = new utente($row);
                }
            } else{
                echo "Error in ".$sql."<br>".$this->startConnection()->error;
            }
            return $user;
        }
    }

?>