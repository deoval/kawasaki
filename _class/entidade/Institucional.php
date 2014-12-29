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
	
	    public static function _lista($where = array(), $limit = "", $order = "") {
        $dbClass = new DB();
        $dbClass->setFrom("institucional");

        if (count($where) > 0) {
            foreach ($where as $consulta) {
                $dbClass->setWhere(" AND " . $consulta);
            }
        }

        if (!empty($order) && $order != NULL && $order != "") {
            $dbClass->setOrder($order);
        }

        if (!empty($limit) && $limit != NULL && $limit != "") {
            $dbClass->setLimit($limit);
        }

        //die($dbClass->Select());
		
        return $dbClass->getArrayBySelect($dbClass->Select());
    }
}

?>
