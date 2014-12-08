<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class CategoriaE extends Eloquent{

    protected $table = 'categoria';
    public $timestamps = false;
    protected $primaryKey = 'id_categoria';

    private $tabela = "categoria";
    private $id_categoria;
    private $nome;
    private $custo_adicional;

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

    public function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCusto_adicional($custo_adicional) {
        $this->custo_adicional = $custo_adicional;
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
        $dbClass->setColuns("COUNT(id_config) AS TOTAL")->setFrom("config");

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
        $dbClass->setColuns("id_config, nome");
        $dbClass->setFrom("config");
        $dbClass->setOrder("nome ASC");
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

    /**
     * Função que que retorna o nome da config
     */
    public static function _getNameByID($codigo) {

        $codigo = (int) $codigo;

        $dbClass = new DB();
        $dbClass->setColuns("nome");
        $dbClass->setFrom("config");
        $dbClass->setWhere(" && id_config = " . $codigo);

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->nome;
    }

    /**
     * Função que que retorna o id da config
     */
    public static function _getIDByAlias($alias) {

        $alias2 = str_replace("-", " ", $alias);

        $dbClass = new DB();
        $dbClass->setColuns("id_config");
        $dbClass->setFrom("config");
        $dbClass->setWhere(" && NomeSemAcento = '" . $alias . "' || NomeSemAcento = '" . $alias2 . "'");

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->id_config;
    }

    /**
     * Função que que retorna o alias da config
     */
    public static function _getAliasByID($codigo) {

        $codigo = (int) $codigo;

        $dbClass = new DB();
        $dbClass->setColuns("NomeSemAcento");
        $dbClass->setFrom("config");
        $dbClass->setWhere(" && id_config = " . $codigo);

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->NomeSemAcento;
    }

    /**
     * Função que que retorna o nome e o id da config para o combo
     */
    public function listaComboConfig($ativo = FALSE) {

        $dbClass = new DB();
        $dbClass->setColuns("nome, nome");
        $dbClass->setFrom("config");
        if ($ativo != FALSE)
            $dbClass->setWhere(" && ativo = '" . $ativo . "'");
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

    /**
     * Função que verifica se a config existe
     */
    public static function _configExist($nome) {

        $dbClass = new DB();
        $dbClass->setColuns("count(id_config) Total");
        $dbClass->setFrom("config");
        $dbClass->setWhere(" && nome = '" . $nome . "'");

        $dbClass->Query($dbClass->Select());

        $result = $dbClass->Fetch();

        $exist = $result->Total > 0 ? TRUE : FALSE;
        return $exist;
    }



}

?>