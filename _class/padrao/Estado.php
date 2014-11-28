<?php


class Estado {

    /**
     * Função que que retorna o nome e a uf do estado apra o combo
     */
    public static function _listaCombo() {

        $dbClass = new DB();
        $dbClass->setColuns("uf, nome");
        $dbClass->setFrom("estado");
        $dbClass->setOrder("nome ASC");
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

    /**
     * Função que que retorna o nome e a uf do estado apra o combo
     */
    public static function _listaComboUF() {

        $dbClass = new DB();
        $dbClass->setColuns("uf, uf");
        $dbClass->setFrom("estado");
        $dbClass->setOrder("nome ASC");
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

    /**
     * Função que que retorna o nome do estado
     */
    public static function _getNameByUf($uf) {
        if(strlen($uf) != 2)
            throw new Exception("UF inválida! ");

        $dbClass = new DB();
        $dbClass->setColuns("nome");
        $dbClass->setFrom("estado");
        $dbClass->setWhere(" && uf = '".$uf."'");

        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();
        return $dado->nome;
    }

}
?>