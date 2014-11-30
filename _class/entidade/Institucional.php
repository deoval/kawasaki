<?php

class Institucional {

    private $tabela = "institucional";
    private $id_institucional;
    private $titulo;
    private $subtitulo;
    private $texto;

    public function __construct() {
        
    }

    public function getTabela() {
        return $this->tabela;
    }
    
    public function getId_institucional() {
        return $this->id_institucional;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getSubtitulo() {
        return $this->subtitulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setId_institucional($id_institucional) {
        $this->id_institucional = $id_institucional;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setSubtitulo($subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }
}

?>
