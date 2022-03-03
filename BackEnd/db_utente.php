<?php

require 'utente.php';

    class db_utente extends db_handler{
        //dichiarazione attributi
        private $utente;

        public function __construct() {
            parent::__construct();
        }

        public function register($user){
            $this->utente = new utente($user);

            $this->startConnection();

            $sql = "INSERT INTO utente (mail, password, nome, cognome, descrizione) VALUES ".
                "('".$this->utente->getMail()."', '".$this->utente->getPassword()."', '".$this->utente->getNome()."', '".$this->utente->getCognome()."', '".$this->utente->getDescrizione()."')";

            $this->getConnection()->query($sql);

            $this->closeconnection();
        }

        //DELETE QUERY

        //UPDATE QUERIES
        public function updateMail($oldMail, $newMail){
            $this->startConnection();

            $sql = "UPDATE utente SET mail = '".$newMail."' WHERE mail LIKE '".$oldMail."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updatePassword($mail, $newPassword){
            $this->startConnection();

            $sql = "UPDATE utente SET password = '".$newPassword."' WHERE mail LIKE '".$mail."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateNome($mail, $newNome){
            $this->startConnection();

            $sql = "UPDATE utente SET nome = '".$newNome."' WHERE mail LIKE '".$mail."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function deleteAccount($mail, $password){
            $this->startConnection();

            if($password == null) {
                $sql = "DELETE FROM utente WHERE mail = '".$mail."'";
            } else {
                $sql = "DELETE FROM utente WHERE mail = '".$mail."' AND password LIKE '".$password."' ";
            }

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if($result == 1) {
                return true;
            } else {
                return false;
            }


        }

        public function updateCognome($mail, $newCognome){
            $this->startConnection();

            $sql = "UPDATE utente SET cognome = '".$newCognome."' WHERE mail LIKE '".$mail."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateDescrizione($mail, $newDescrizione){
            $this->startConnection();

            $sql = "UPDATE utente SET descrizione = '".$newDescrizione."' WHERE mail LIKE '".$mail."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        public function updateNascita($mail, $newNascita){
            $this->startConnection();

            $sql = "UPDATE utente SET nascita = '".$newNascita."' WHERE mail LIKE '".$mail."'";

            if($this->getConnection()->query($sql) === TRUE){
                //successfully updated
            }

            $this->closeconnection();
        }

        //In base all'email e la password inserita ricavo nome e cognome dell'utente
        public function access_User($mail, $password){
            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE mail LIKE '".$mail."' AND password LIKE '".$password."'";

            $result = $this->getConnection()->query($sql);

            $conta = mysqli_num_rows($result);

            $this->closeconnection();

            if($result->num_rows == 1 && $mail != '' && $password != ''){
                $row = $result->fetch_assoc();
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['cognome'] = $row['cognome'];
                $_SESSION['mail'] = $row['mail'];
                $_SESSION['google'] = false;
                return true;
            }else{
                return false;
            }
        }
        //END UPDATE QUERIES

        //Controllo che l'email sia presente nel database
        public function checkUtente($mail){
            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE mail LIKE '".$mail."'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if($result->num_rows == 1) {
                // output data of each row
                return false;
            }else{
                return true;
            }
        }

        // Funzione per la modifica della password
        public function checkUtentePass($mail, $oldpassword, $newpassword){
            $this->startConnection();

            $sql = "SELECT password FROM utente WHERE mail LIKE '".$mail."'";

            $result = $this->getConnection()->query($sql);

            $this->closeconnection();

            if($result->num_rows == 1) {
                $utente = new db_utente();
                $row = $result->fetch_assoc();
                if($newpassword != $row['password']){
                    if($oldpassword == $row['password']) {
                        $utente->updatePassword($mail, $newpassword);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

        public function setUtente($mail){
            $this->startConnection();

            $sql = "SELECT * FROM utente WHERE mail LIKE '".$mail."'";

            $result = $this->getConnection()->query($sql);

            if($result->num_rows == 1) {
                //fetch_assoc recupera la riga dal database come un array associativo.
                //Tale è un array i cui elementi sono accessibili mediante nomi, quindi stringhe anziché indici puramente numerici.
                //$row è il vettore associativo
                $row = $result->fetch_assoc();
                $this->utente = new utente($row);
            }

            $this->utente = new utente($row);

            $this->closeconnection();
        }

        public function getUtente(){
            return $this->utente;
        }

    }

?>