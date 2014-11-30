<?php

class Motoboy {

    private $tabela = "motoboy";
    private $id_motoboy;
    private $nome;
    private $email;
    private $data_nascimento;
    private $telefone;
    private $celular;
    private $placa;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $lat;
    private $lng;
    private $cpf;
    private $rg;
    private $condumoto;
    private $licenca;
    private $senha;
    private $imagem;
    private $copia_cnh;
    private $termos;
    private $ativo;

    public function __construct() {
        
    }

    public function getTabela() {
        return $this->tabela;
    }
    
    public function getId_motoboy() {
        return $this->id_motoboy;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getPlaca() {
        return $this->placa;
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

    public function getLat() {
        return $this->lat;
    }

    public function getLng() {
        return $this->lng;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getRg() {
        return $this->rg;
    }

    public function getCondumoto() {
        return $this->condumoto;
    }

    public function getLicenca() {
        return $this->licenca;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getCopia_cnh() {
        return $this->copia_cnh;
    }

    public function getTermos() {
        return $this->termos;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setId_motoboy($id_motoboy) {
        $this->id_motoboy = $id_motoboy;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setPlaca($placa) {
        $this->placa = $placa;
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

    public function setLat($lat) {
        $this->lat = $lat;
    }

    public function setLng($lng) {
        $this->lng = $lng;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setCondumoto($condumoto) {
        $this->condumoto = $condumoto;
    }

    public function setLicenca($licenca) {
        $this->licenca = $licenca;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setCopia_cnh($copia_cnh) {
        $this->copia_cnh = $copia_cnh;
    }

    public function setTermos($termos) {
        $this->termos = $termos;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }



}

?>
