<?php

class SqlUsuario Extends SqlPadrao {

    protected $obj;

    public function __construct($id = 0, $encode = false) {
        $this->obj = new Usuario();

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
        $dbClass->setColuns("U.*, UP.titulo AS PERFIL")->setFrom("usuario U")->setJoin("INNER JOIN usuario_perfil UP ON U.id_usuario_perfil = UP.id_usuario_perfil");

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
        $dbClass->setColuns("COUNT(U.id_usuario) AS TOTAL")->setFrom("usuario U")->setJoin("INNER JOIN usuario_perfil UP ON U.id_usuario_perfil = UP.id_usuario_perfil");

        if (count($where) > 0) {
            foreach ($where as $consulta) {
                $dbClass->setWhere(" AND " . $consulta);
            }
        }

        $dbClass->Query($dbClass->Select());
        $objCount = $dbClass->Fetch();
        
        return $objCount->TOTAL;
    }

    public static function _login($user, $senha) {
        $user = addslashes($user);
        $senha = md5(addslashes($senha));

        $dbClass = new DB();
        $dbClass->setFrom("usuario");
        $dbClass->setWhere(" && (usuario = '" . $user . "' || email = '" . $user . "')");
        $dbClass->setWhere(" && senha = '" . $senha . "'");
        $dbClass->setWhere(" && ativo = 1");

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        if ($dbClass->NumRows() == 0)
            throw new Exception("Usuário ou senha inválidos");

        $dbClass->Close();

        $_SESSION[_EMPRESA_]["SYS"]["id_usuario"] = $dado->id_usuario;
        $_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] = $dado->id_usuario_perfil;
        $_SESSION[_EMPRESA_]["SYS"]["nome"] = $dado->nome;
        $_SESSION[_EMPRESA_]["SYS"]["usuario"] = $dado->usuario;

        return true;
    }

    public static function _checkLogin($login, $id) {
        $login = addslashes($login);
        $id = (int) $id;

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_usuario) AS CONT");
        $dbClass->setFrom("usuario");
        $dbClass->setWhere(" && usuario = '" . $login . "'");
        $dbClass->setWhere(" && id_usuario != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _checkEmail($email, $id) {
        $email = Util::LS($email);

        $dbClass = new DB();
        $dbClass->setColuns("COUNT(id_usuario) AS CONT");
        $dbClass->setFrom("usuario");
        $dbClass->setWhere(" && email = '" . $email . "'");
        $dbClass->setWhere(" && id_usuario != " . $id);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    public static function _getIdByEmail($email) {
        $email = Util::LS($email);

        $dbClass = new DB();
        $dbClass->setColuns("id_usuario");
        $dbClass->setFrom("usuario");
        $dbClass->setWhere(" && email = '" . $email . "'");

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        if ($dbClass->NumRows() == 0)
            throw new Exception("Nenhum usuário encontrado com esse e-mail!");

        return $dado->id_usuario;
    }

    /**
     * Função que que retorna o nome e o id do perfil para o combo
     */
    public static function _listaComboPerfil() {

        $dbClass = new DB();
        $dbClass->setColuns("id_usuario_perfil, titulo");
        $dbClass->setFrom("usuario_perfil");
        $dbClass->setWhere(" && id_usuario_perfil >= " . $_SESSION[_EMPRESA_]["SYS"]['id_usuario_perfil']);
        return $dbClass->getArrayBySelect($dbClass->Select());
    }

}

?>