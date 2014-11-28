<?php

class Solicitacao_endereco {

	private $tabela = "solicitacao_endereco";
	private $id_solicitacao_endereco;
	private $lat;
	private $long;
	private $cep;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cidade;
	private $observacao;
	private $responsavel;

    public function __construct() {
        
    }

    public function getTabela() {
        return $this->tabela;
    }
    
    public function getId_solicitacao_endereco() {
        return $this->id_solicitacao_endereco;
    }
	
	public function getLat() {
        return $this->lat;
    }
	public function getLong() {
        return $this->long;
    }
	public function getCep() {
        return $this->cep;
    }
	public function getEndereco() {
        return $this->endereco;
    }
	public function getNumero() {
        return $this->numero;
    }
	public function getComplemento() {
        return $this->complemento;
    }
	public function getBairro() {
        return $this->bairro;
    }
	public function getCidade() {
        return $this->cidade;
    }
	public function getObservacao() {
        return $this->observacao;
    }
	public function getResponsavel() {
        return $this->responsavel;
    }
	

    public function setId_solicitacao($id_solicitacao) {
        $this->id_solicitacao = $id_solicitacao;
    }
	
	public function setId_solicitacao_endereco($id_solicitacao_endereco) {
        $this->id_solicitacao_endereco = $id_solicitacao_endereco;
    }
	
	public function setLat($lat) {
        $this->lat = $lat;
    }
	
	public function setLong($long) {
        $this->long = $long;
    }
	
	public function setCep($cep) {
        $this->cep = $cep;
    }
	
	public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
	
	public function setNumero($numero) {
        $this->numero = $numero;
    }
	
	public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
	
	public function setBairro($bairro) {
        $this->bairro = $bairro;
    }
	
	public function setCidade($cidade) {
        $this->cidade = $cidade;
    }
	
	public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }
	
	public function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }
	

}

?>
