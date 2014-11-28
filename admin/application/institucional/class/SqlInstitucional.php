<?php

class SqlInstitucional Extends SqlPadrao {

    protected $obj;

    public function __construct($id = 0, $encode = false) {
        $this->obj = new Institucional();

        $id = (int) $id;

        if ($id > 0)
            $this->Carrega($id, $encode);
        else
            $this->CarregaDefault();
    }

    /**
     * Função que que retorna um array com o resultado da pesquisa
     */
    public static function _lista($where = array(), $limit = "", $order = "") {
        $dbClass = new DB();
        $dbClass->setFrom("institucional");

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
        $dbClass->setColuns("COUNT(id_institucional) AS TOTAL")->setFrom("institucional");

        if (count($where) > 0) {
            foreach ($where as $consulta) {
                $dbClass->setWhere(" AND " . $consulta);
            }
        }

        $dbClass->Query($dbClass->Select());
        $objCount = $dbClass->Fetch();
        
        return $objCount->TOTAL;
    }

}

?>