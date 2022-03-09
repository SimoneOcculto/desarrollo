<?php

    class db_handler {

        private $servername;
        private $username;
        private $dbname;
        private $connection;

        public function getP(){return "";}

        public function __construct() {
            $this->servername = "localhost";
            $this->username = "root";
            $this->pwd = "";
            $this->dbname = "db_desarrollo";
        }

        public function setServername($servername) {
            $this->servername = $servername;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function setPassword() {
            $this->pwd = "";
        }

        public function setDbname ($db) {
            $this->dbname = $db;
        }

        public function getConnection(){
            return $this->connection;
        }

        public function startConnection() {
            $this->connection = new mysqli($this->servername, $this->username, "", $this->dbname);
        }

        public function closeconnection() {
            $this->connection->close();
        }

    }

?>