<?php

class SqlMotoboy Extends SqlPadrao {

    protected $obj;

    public function __construct($id = 0, $encode = false) {
        $this->obj = new Motoboy();

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
        $dbClass->setFrom("motoboy");

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

    /**
     * Função que que retorna um array com o resultado da pesquisa
     */
    public static function _totalRegistros($where = array()) {
        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_motoboy) AS TOTAL")->setFrom("motoboy");

        if (count($where) > 0) {
            foreach ($where as $consulta) {
                $dbClass->setWhere(" AND " . $consulta);
            }
        }

        $dbClass->Query($dbClass->Select());
        $objCount = $dbClass->Fetch();
        
        return $objCount->TOTAL;
    }


    public static function _getIdByEmail($email) {
        $email = Util::LS($email);

        $dbClass = new DB();
        $dbClass->setColuns("id_motoboy");
        $dbClass->setFrom("motoboy");
        $dbClass->setWhere(" && email = '" . $email . "'");

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->id_motoboy;
    }

    public static function _checkEmail($email, $id) {
        $email = Util::LS($email);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_motoboy) AS CONT");
        $dbClass->setFrom("motoboy");
        $dbClass->setWhere(" && email = '" . $email . "'");
        $dbClass->setWhere(" && id_motoboy != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _checkCpf($cpf, $id) {
        $cpf = Util::LS($cpf);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_motoboy) AS CONT");
        $dbClass->setFrom("motoboy");
        $dbClass->setWhere(" && cpf = '" . $cpf . "'");
        $dbClass->setWhere(" && id_motoboy != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _checkRg($rg, $id) {
        $rg = Util::LS($rg);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_motoboy) AS CONT");
        $dbClass->setFrom("motoboy");
        $dbClass->setWhere(" && rg = '" . $rg . "'");
        $dbClass->setWhere(" && id_motoboy != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _checkPlaca($placa, $id) {
        $placa = Util::LS($placa);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_motoboy) AS CONT");
        $dbClass->setFrom("motoboy");
        $dbClass->setWhere(" && placa = '" . $placa . "'");
        $dbClass->setWhere(" && id_motoboy != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _login($user, $senha) {
        $user = addslashes($user);
        $senha = md5(addslashes($senha));

        $dbClass = new DB();
        $dbClass->setFrom("motoboy");
        $dbClass->setWhere(" && email = '" . $user . "'");
        $dbClass->setWhere(" && senha = '" . $senha . "'");
        $dbClass->setWhere(" && ativo = 1");

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        if ($dbClass->NumRows() == 0) {
            return false;
        } else {
            $_SESSION['site'][_EMPRESA_]['motoboy']["id_motoboy"] = $dado->id_motoboy;
            $_SESSION['site'][_EMPRESA_]['motoboy']["nome"] = $dado->nome;
            $_SESSION['site'][_EMPRESA_]['motoboy']["sobrenome"] = $dado->sobrenome;
            $_SESSION['site'][_EMPRESA_]['motoboy']["email"] = $dado->email;
            return true;
        }
        $dbClass->Close();
    }

}

?>
