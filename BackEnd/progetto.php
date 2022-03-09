<?php

class progetto{
    //Dichiarazione Attributi
    private $id;
    private $leader;
    private $nome;
    private $descrizione;
    private $data_scadenza;
    private $data_creazione;

    //Definizione Metodi
    public function __construct($array){
        if(array_key_exists('id', $array))
            $this->id = $array['id'];
        $this->leader = $array['leader'];
        $this->nome = $array['nome'];
        $this->descrizione = $array['descrizione'];
        $this->data_scadenza = $array['data_scadenza'];
        $this->data_creazione = $array['data_creazione'];
    }

    public function getId(){
        return $this->id;
    }

    public function getLeader(){
        return $this->leader;
    }

    public function getNomeP(){
        return $this->nome;
    }

    public function getDescrizioneP(){
        return $this->descrizione;
    }

    public function getDataScadenzaP(){
        return $this->data_scadenza;
    }

    public function getDataCreazioneP(){
        return $this->data_creazione;
    }
}

?>