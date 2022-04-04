<?php

    require 'C:/xampp/htdocs/desarrollo/Model/utente.php';

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

            $sql = "INSERT INTO utente (Mail, Password, Nome, Cognome, Ruolo) VALUES
                    ('" . $this->utente->getMail() . "', '" . $this->utente->getPassword() . "', '" . $this->utente->getNome() . "', '" . $this->utente->getCognome() . "', '" . $this->utente->getRuolo() . "')";

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

            $sql = "SELECT Nome, Cognome, Mail, Password, Ruolo  FROM utente WHERE Mail='".$mail."'";

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

        public function getAllUtenti(){

            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE Ruolo = 'U' ORDER BY Nome, Cognome";

            $result = $this->getConnection()->query($sql);

            $array = array();

            $this->closeconnection();

            if($result) {
                if ($result->num_rows == 0) {
                    return false;
                } else {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $row = $result->fetch_assoc();
                        $user = new utente($row);
                        $array[] = $user;
                    }
                }
            } else{
                echo "Error in ".$sql."<br>".$this->startConnection()->error;
            }
            return $array;
        }

        public function UpdateUser($user){

            $this->utente = new utente($user);

            $this->startConnection();

            $sql = "SELECT Nome FROM utente WHERE Mail='".$this->utente->getMail()."'";

            $nome=$this->getConnection()->query($sql);

            $row = $nome->fetch_assoc();

            if(strcmp($row['Nome'],$this->utente->getNome()) != 0){
                $cambioN="UPDATE utente SET Nome='".$this->utente->getNome()."' WHERE Mail='".$this->utente->getMail()."'";
                $this->getConnection()->query($cambioN);
            }

            $sql = "SELECT Cognome FROM utente WHERE Mail='".$this->utente->getMail()."'";

            $cognome=$this->getConnection()->query($sql);

            $row = $cognome->fetch_assoc();

            if(strcmp($row['Cognome'],$this->utente->getCognome()) != 0){
                $cambioC="UPDATE utente SET Cognome='".$this->utente->getCognome()."' WHERE Mail='".$this->utente->getMail()."'";
                $this->getConnection()->query($cambioC);
            }

            $this->closeconnection();

        }

        public function EliminaUtente($mail){

            $this->startConnection();

            $sql = "DELETE FROM utente WHERE Mail='".$mail."'";

            $this->getConnection()->query($sql);

            $this->closeconnection();

        }
    }

?>