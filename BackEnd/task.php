<?php

class task{

    //Dichiarazione Attributi
    private $ID_Task;
    private $Progetto;
    private $NomeT;
    private $DescrizioneT;
    private $DataScadenzaT;
    private $DataCreazioneT;
    private $Priorita;

    //Definizione Metodi
    public function __construct($array){
        if(array_key_exists('ID_Task', $array))
            $this->ID_Task = $array['ID_Task'];
        $this->Progetto = $array['Progetto'];
        $this->NomeT = $array['NomeT'];
        $this->DescrizioneT = $array['DescrizioneT'];
        $this->DataScadenzaT = $array['DataScadenzaT'];
        $this->DataCreazioneT = $array['DataCreazioneT'];
        $this->Priorita = $array['Priorita'];
    }

    public function getId_task(){
        return $this->ID_Task;
    }

    public function getId_progetto(){
        return $this->Progetto;
    }

    public function getNomeT(){
        return $this->NomeT;
    }

    public function getDescrizioneT(){
        return $this->DescrizioneT;
    }

    public function getDataScadenzaT(){
        return $this->DataScadenzaT;
    }

    public function getDataCreazioneT(){
        return $this->DataCreazioneT;
    }

    public function getPriorita(){
        return $this->Priorita;
    }
}

?>
