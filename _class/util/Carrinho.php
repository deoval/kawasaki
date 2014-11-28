<?php

class Carrinho {

    private $contador;
    private $cotaUnica;

    /**
     * CONSTRUTOR
     */
    public function __construct() {
            $this->contador = $this->getContador() > 0?$this->getContador():0;
    }

    public function setContador($quantidade) {
        $this->contador += $quantidade;
    }

    public function getContador() {
        return (int)$this->contador;
    }

    public function getCotaUnica() {
        return $_SESSION['CARRINHO']["COTA_UNICA"];
    }

    public function setCotaUnica($cotaUnica) {
        $_SESSION['CARRINHO']["COTA_UNICA"] = $cotaUnica;
    }

    public function CriaSessao() {
        if (!isset($_SESSION['CARRINHO'])) {
            $_SESSION['CARRINHO'] = array();
        }
    }

    public function pegaArray() {
        return $_SESSION['CARRINHO'];
    }

    public function ContaItens() {
        return count($_SESSION['CARRINHO']);
    }

    public function ContaQtd() {
        $arrayItens = $this->pegaArray();
        $totalQtd = 0;
        
        foreach ($arrayItens as $item) {
            $totalQtd += $item['qtd'];
        }
        
        return $totalQtd;
    }

    public function TerminaSessao() {
        $_SESSION['CARRINHO'] = array();
        unset($_SESSION['CARRINHO']);
        //session_unset($_SESSION['CARRINHO']);
    }

    /**
     * Adiciona item ao carrinho
     * @param string $codigo
     * @param int $qtd
     */
    public function Add($codigo, $qtd = 0) {
        if ($codigo != "" && $qtd > 0) {
            if(!isset($_SESSION['CARRINHO'][$codigo])) {
                $_SESSION['CARRINHO'][$codigo]["codigo"] = $codigo;
                $_SESSION['CARRINHO'][$codigo]["qtd"] = (int) $qtd;
            } else {
                $_SESSION['CARRINHO'][$codigo]["qtd"] += (int) $qtd;
            }
            $this->setContador((int) $qtd);
        }
        else
            throw new Exception("O Código " . $codigo . " ou quantidade " . $qtd . " são invalidos! ");
    }

    /**
     * Pega a quantidade de um item
     * @param string $codigo
     * @return int quantidade
     */
    public function getQTD($codigo) {
        return $_SESSION['CARRINHO'][$codigo]["qtd"];
    }

    /**
     * Altera a quantidade
     * @param string $codigo
     * @param int $qtd
     */
    public function Altera($codigo, $qtd = 0) {
        if ($codigo != "" && $qtd > 0) {
            $bufferCount = (int) $_SESSION['CARRINHO'][$codigo]["qtd"];
            $_SESSION['CARRINHO'][$codigo]["qtd"] = (int) $qtd;
            $this->contador = (($this->contador - $bufferCount) + $_SESSION['CARRINHO'][$codigo]["qtd"]);
        }
        else
            throw new Exception("O Código " . $codigo . " ou quantidade " . $qtd . " são invalidos! ");
    }

    public function Remove($codigo) {
        if ($codigo != "") {
            $this->contador = $this->contador - $_SESSION['CARRINHO'][$codigo]["QTD"];
            unset($_SESSION['CARRINHO'][$codigo]);
        }
        else
            throw new Exception("O Código " . $codigo . " é invalido! ");
    }

}
?>