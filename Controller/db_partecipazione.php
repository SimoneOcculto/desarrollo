<?php

    require 'C:/xampp/htdocs/desarrollo/Model/partecipazione.php';

    class db_partecipazione extends db_handler{
        //dichiarazione attributi
        private $progetto;

        public function __construct() {
            parent::__construct();
        }
    }

?>