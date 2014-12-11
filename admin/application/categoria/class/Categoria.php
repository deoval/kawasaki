<?php

class Categoria{

    private $tabela = "categoria";
    private $id_categoria;
    private $nome;
    private $custo_adicional;
	private $disponivel;

    public function __construct() {}

    public function getTabela() {
        return $this->tabela;
    }

    public function getId_categoria() {
        return $this->id_categoria;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCusto_adicional() {
        return $this->custo_adicional;
    }
	
	public function getDisponivel() {
        return $this->disponivel;
    }

    public function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCusto_adicional($custo_adicional) {
        $this->custo_adicional = $custo_adicional;
    }
	
	public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }
}

?>