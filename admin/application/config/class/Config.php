<?php

class Config{

    private $tabela = "config";
    private $id_config;
    private $item;
    private $value;

    public function __construct() {}

    public function getTabela() {
        return $this->tabela;
    }

    public function getId_config() {
        return $this->id_config;
    }

    public function getItem() {
        return $this->item;
    }

    public function getValue() {
        return $this->value;
    }

    public function setId_config($id_config) {
        $this->id_config = $id_config;
    }

    public function setItem($item) {
        $this->item = $item;
    }

    public function setValue($value) {
        $this->value = $value;
    }


}

?>