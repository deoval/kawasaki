<?php

class Usuario{

    private $tabela = "usuario";
    private $id_usuario;
    private $nome;
    private $sobrenome;
    private $email;
    private $telefone;
    private $data_nascimento;
    private $ativo;
    private $id_usuario_perfil;
    private $usuario;
    private $senha;
    private $imagem;

    public function __construct() {}

    public function getTabela() {
        return $this->tabela;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getId_usuario_perfil() {
        return $this->id_usuario_perfil;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setId_usuario_perfil($id_usuario_perfil) {
        $this->id_usuario_perfil = $id_usuario_perfil;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }


}

?>