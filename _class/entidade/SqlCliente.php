<?php

class SqlCliente Extends SqlPadrao {

    protected $obj;

    public function __construct($id = 0, $encode = false) {
        $this->obj = new Cliente();

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
        $dbClass->setFrom("cliente");

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
        $dbClass->setColuns("COUNT(id_cliente) AS TOTAL")->setFrom("cliente");

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
        $dbClass->setColuns("id_cliente");
        $dbClass->setFrom("cliente");
        $dbClass->setWhere(" && email = '" . $email . "'");

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->id_cliente;
    }

    public static function _checkEmail($email, $id) {
        $email = Util::LS($email);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_cliente) AS CONT");
        $dbClass->setFrom("cliente");
        $dbClass->setWhere(" && email = '" . $email . "'");
        $dbClass->setWhere(" && id_cliente != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _checkCpf($cpf, $id) {
        $cpf = Util::LS($cpf);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_cliente) AS CONT");
        $dbClass->setFrom("cliente");
        $dbClass->setWhere(" && cpf = '" . $cpf . "'");
        $dbClass->setWhere(" && id_cliente != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _checkCnpj($cnpj, $id) {
        $cnpj = Util::LS($cnpj);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_cliente) AS CONT");
        $dbClass->setFrom("cliente");
        $dbClass->setWhere(" && cnpj = '" . $cnpj . "'");
        $dbClass->setWhere(" && id_cliente != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _login($user, $senha) {
        $user = addslashes($user);
        $senha = md5(addslashes($senha));

        $dbClass = new DB();
        $dbClass->setFrom("cliente");
        $dbClass->setWhere(" && email = '" . $user . "'");
        $dbClass->setWhere(" && senha = '" . $senha . "'");
        $dbClass->setWhere(" && ativo = 1");

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        if ($dbClass->NumRows() == 0) {
            return false;
        } else {
            $_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"] = $dado->id_cliente;
            $_SESSION['site'][_EMPRESA_]['cliente']["nome"] = $dado->nome;
            $_SESSION['site'][_EMPRESA_]['cliente']["email"] = $dado->email;
            return true;
        }
        $dbClass->Close();
    }

}

?>
