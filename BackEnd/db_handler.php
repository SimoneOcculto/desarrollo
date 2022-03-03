<?php

    class db_handler {

        private $servername;
        private $username;
        //private $pwd;
        private $dbname;
        private $connection;

        private function getP(){return "";}

        public function __construct() {
            $this->servername = "localhost";
            $this->username = "root";
            //$this->pwd = getP();
            $this->dbname = "db_desarrollo";
        }

        public function setServername($servername) {
            $this->servername = $servername;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        /*public function setPassword($pwd) {
            $this->pwd = $pwd;
        }*/

        public function setDbname ($db) {
            $this->dbname = $db;
        }

        public function getConnection(){
            return $this->connection;
        }

        public function startConnection() {
            $this->connection = new mysqli($this->servername, $this->username, /*$this->pwd,*/ $this->dbname);
        }

        public function closeconnection() {
            $this->connection->close();
        }

    }

?>