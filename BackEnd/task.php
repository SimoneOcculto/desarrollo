<?php

class task{

    //Dichiarazione Attributi
    private $id_task;
    private $id_progetto;
    private $nomeT;
    private $descrizioneT;
    private $data_scadenzaT;
    private $data_creazioneT;
    private $priorita;

    //Definizione Metodi
    public function __construct($array){
        if(array_key_exists('id', $array))
            $this->id_task = $array['id_task'];
        $this->id_progetto = $array['id_progetto'];
        $this->nomeT = $array['nomeT'];
        $this->descrizioneT = $array['descrizioneT'];
        $this->data_scadenzaT = $array['data_scadenzaT'];
        $this->data_creazioneT = $array['data_creazioneT'];
        $this->priorita = $array['priorita'];
    }

    public function getId_task(){
        return $this->id_task;
    }

    public function getId_progetto(){
        return $this->id_progetto;
    }

    public function getNomeT(){
        return $this->nomeT;
    }

    public function getDescrizioneT(){
        return $this->descrizioneT;
    }

    public function getDataScadenzaT(){
        return $this->data_scadenzaT;
    }

    public function getDataCreazioneT(){
        return $this->data_creazioneT;
    }

    public function getPriorita(){
        return $this->priorita;
    }
}

?>
