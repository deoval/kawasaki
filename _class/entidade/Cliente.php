<?php

class Cliente{

    private $tabela = "cliente";
    private $id_cliente;
    private $nome;
    private $email;
    private $cpf;
    private $cnpj;
    private $telefone;
    private $senha;
    private $termos;
    private $ativo;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $cod_verificacao;
	private $empresa;

    public function __construct() {

    }

    public function getTabela() {
        return $this->tabela;
    }
    
    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getTermos() {
        return $this->termos;
    }

    public function getAtivo() {
        return $this->ativo;
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
	
	public function getCod_verificacao() {
        return $this->cod_verificacao;
    }
	
	public function getEmpresa() {
        return $this->empresa;
    }

    public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setTermos($termos) {
        $this->termos = $termos;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
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

    public function setCod_verificacao($cod_verificacao) {
        $this->cod_verificacao = $cod_verificacao;
    }
	
    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }	
}

?>
