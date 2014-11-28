<?php

abstract class Entidade {
    private $nome;
    private $email;
    private $ativo;

    final public function getNome() {
        return $this->nome;
    }

    final public function getEmail() {
        return $this->email;
    }

    final public function getAtivo() {
        return $this->ativo;
    }

    final public function setNome($value) {
        $this->nome = $value;
    }

    final public function setEmail($value) {
        $this->email =  $value;
    }

    final public function setAtivo($value) {
        $this->ativo = $value;
    }
}

?>
