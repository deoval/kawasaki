<?php

class Solicitacao {

   	private $tabela = "solicitacao";
	private $id_solicitacao;
	private $id_cliente;
	private $id_motoboy;
	private $id_solicitacao_endereco_busca;
	private $id_solicitacao_endereco_entrega;
	private $id_categoria;
	private $data;
	private $valor;
	private $ativo;
	private $tipo_solicitacao;
	private $escala_delivery;
	

    public function __construct() {
        
    }

    public function getTabela() {
        return $this->tabela;
    }
    
    public function getId_solicitacao() {
        return $this->id_solicitacao;
    }
	
	public function getId_cliente() {
        return $this->id_cliente;
    }
	
	public function getId_motoboy() {
        return $this->id_motoboy;
    }
	
	public function getId_solicitacao_endereco_busca() {
        return $this->id_solicitacao_endereco_busca;
    }
	
	public function getId_solicitacao_endereco_entrega() {
        return $this->id_solicitacao_endereco_entrega;
    }
	
	public function getId_categoria() {
        return $this->id_categoria;
    }
	
	public function getData() {
        return $this->data;
    }
	
	public function getValor() {
        return $this->valor;
    }
	
	public function getAtivo() {
        return $this->ativo;
    }
	
	public function getTipo_solicitacao() {
		return $this->tipo_solicitacao;
	}
	
	public function getEscala_delivery() {
		return $this->escala_delivery;
	}

    public function setId_solicitacao($id_solicitacao) {
        $this->id_solicitacao = $id_solicitacao;
    }
	
	public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }
	
	public function setId_motoboy($id_motoboy) {
        $this->id_motoboy = $id_motoboy;
    }
	
	public function setId_solicitacao_endereco_busca($id_solicitacao_endereco_busca) {
        $this->id_solicitacao_endereco_busca = $id_solicitacao_endereco_busca;
    }
	
	public function setId_solicitacao_endereco_entrega($id_solicitacao_endereco_entrega) {
        $this->id_solicitacao_endereco_entrega = $id_solicitacao_endereco_entrega;
    }

	public function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

	public function setData($data) {
        $this->data = $data;
    }
	
	public function setValor($valor) {
        $this->valor = $valor;
    }

	public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

	public function setTipo_solicitacao($tipo_solicitacao) {
		$this->tipo_solicitacao = $tipo_solicitacao;
	}
	
	public function setEscala_delivery($escala_delivery) {
		$this->escala_delivery= $escala_delivery;
	}
	
}

?>
