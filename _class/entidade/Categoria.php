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
	
		    /**
     * Função que que retorna um array com o resultado da pesquisa
     */
    public static function _lista($where = array(), $limit = "", $order = "") {
        $dbClass = new DB();
        $dbClass->setFrom("categoria");

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
    
    public static function _totalRegistros($where = array()) {
        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_categoria) AS TOTAL")->setFrom("categoria");

        if (count($where) > 0) {
            foreach ($where as $consulta) {
                $dbClass->setWhere(" AND " . $consulta);
            }
        }

        $dbClass->Query($dbClass->Select());
        $objCount = $dbClass->Fetch();
        
        return $objCount->TOTAL;
    }

    /**
     * Função que que retorna um array com o resultado da pesquisa
     */
    public static function _listaCombo() {
        $dbClass = new DB();
        $dbClass->setColuns("id_categoria, nome");
        $dbClass->setFrom("categoria");
        $dbClass->setOrder("nome ASC");
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

    /**
     * Função que que retorna o nome da categoria
     */
    public static function _getNameByID($codigo) {

        $codigo = (int) $codigo;

        $dbClass = new DB();
        $dbClass->setColuns("nome");
        $dbClass->setFrom("categoria");
        $dbClass->setWhere(" && id_categoria = " . $codigo);

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->nome;
    }

    /**
     * Função que que retorna o id da categoria
     */
    public static function _getIDByAlias($alias) {

        $alias2 = str_replace("-", " ", $alias);

        $dbClass = new DB();
        $dbClass->setColuns("id_categoria");
        $dbClass->setFrom("categoria");
        $dbClass->setWhere(" && NomeSemAcento = '" . $alias . "' || NomeSemAcento = '" . $alias2 . "'");

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->id_categoria;
    }

    /**
     * Função que que retorna o alias da categoria
     */
    public static function _getAliasByID($codigo) {

        $codigo = (int) $codigo;

        $dbClass = new DB();
        $dbClass->setColuns("NomeSemAcento");
        $dbClass->setFrom("categoria");
        $dbClass->setWhere(" && id_categoria = " . $codigo);

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->NomeSemAcento;
    }

    /**
     * Função que que retorna o nome e o id da categoria para o combo
     */
    public function listaComboCategoria($ativo = FALSE) {

        $dbClass = new DB();
        $dbClass->setColuns("nome, nome");
        $dbClass->setFrom("categoria");
        if ($ativo != FALSE)
            $dbClass->setWhere(" && ativo = '" . $ativo . "'");
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

    /**
     * Função que verifica se a categoria existe
     */
    public static function _categoriaExist($nome) {

        $dbClass = new DB();
        $dbClass->setColuns("count(id_categoria) Total");
        $dbClass->setFrom("categoria");
        $dbClass->setWhere(" && nome = '" . $nome . "'");

        $dbClass->Query($dbClass->Select());

        $result = $dbClass->Fetch();

        $exist = $result->Total > 0 ? TRUE : FALSE;
        return $exist;
    }


	
}

?>