<?php

class SqlPadrao {

    public function __get($name) {
        $campoGet = 'get' . ucfirst($name);
        return $this->obj->$campoGet();
    }

    public function __set($name, $value) {
        $campoSet = 'set' . ucfirst($name);
        $this->obj->$campoSet($value);
    }

    /**
     * Função que pega o nome dos campos de uma tabela
     * @param array
     */
    public function Prepare($arr, $decode = false) {

        foreach ($arr as $campo => $value) {
            if ($decode === true)
                $value = utf8_decode($value);

            $campoSet = "set" . ucfirst($campo);
            if (method_exists($this->obj, $campoSet)) {
                //$value = get_magic_quotes_gpc() == true ? $value : addslashes($value);
                $this->obj->$campoSet($value);
            }
        }
    }

    /**
     * Função que inicializa as variaveis
     */
    public function CarregaDefault() {

        $dbClass = New DB();

        $dbClass->Query($dbClass->Fields($this->obj->getTabela()));

        while ($dado = $dbClass->Fetch()) {

            $campoSet = "set" . ucfirst($dado->Field);

            if (preg_match("(int)", $dado->Type)) {
                $valor = $dado->Default != "" || $dado->Default != null ? $dado->Default : 0;
                $this->obj->$campoSet($valor);
            } else if (preg_match("(date)", $dado->Type)) {
                $this->obj->$campoSet(NULL);
            } else {
                $valor = $dado->Default != "" || $dado->Default != null ? $dado->Default : '';
                $this->obj->$campoSet($valor);
            }
        }

        $dbClass->Close();
    }

    /**
     * Função que carrega os dados do banco para o objeto
     * @param int $codigo
     */
    public function Carrega($codigo, $encode = false) {
        $codigo = (int) $codigo;

        $dbClass = new DB();
        $dbClass->setFrom($this->obj->getTabela());
        $dbClass->setWhere(" && id_" . $this->obj->getTabela() . " = " . $codigo);
        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();

        if ($dbClass->NumRows() > 0) {
            $dbClass->Query($dbClass->Fields($this->obj->getTabela()));
            while ($field = $dbClass->Fetch()) {
                $fcampo = $field->Field;
                $value = $encode === true ? utf8_encode($dado->$fcampo) : $dado->$fcampo;
                $campoSet = "set" . ucfirst($fcampo);
                $this->obj->$campoSet(stripslashes($value));
            }
        } else {
         var_dump(" && id_" . $this->obj->getTabela() . " = " . $codigo);

            throw new Exception("Falha ao carregar os dados! ");
        }

        $dbClass->Close();
    }

    /**
     * Função que cadastra os dados no banco
     */
    public function Cadastra() {

        $dbClass = new DB();
        $dbClass->Query($dbClass->Fields($this->obj->getTabela()));

        $ini = 1;
        $cont = $dbClass->NumRows();

        $sql = "INSERT INTO " . $this->obj->getTabela() . " (";

        while ($dado = $dbClass->Fetch()) {
            $sql .= $dado->Field;
            if ($cont != $ini)
                $sql .= ",";
            $getCampo[] = $dado->Field;
            $ini++;
        }

        $sql .= ") VALUES (";

        $ini = 1;

        foreach ($getCampo as $campo) {

            $campoGet = "get" . ucfirst($campo);

            if (is_null($this->obj->$campoGet()))
                $sql .= "NULL";
            else
                $sql .= "'" . (get_magic_quotes_gpc() == true ? $this->obj->$campoGet() : addslashes($this->obj->$campoGet())) . "'";

            if ($cont != $ini)
                $sql .= ",";
            $ini++;
        }

        $sql .= ");";
        // var_dump($sql);die();

        if (!$dbClass->Query($sql))
            throw new Exception('Falha ao cadastrar os dados.');

        $campoSetId = "setId_" . $this->obj->getTabela();
        $this->obj->$campoSetId($dbClass->LastInsertId());

        $dbClass->Close();
    }

    /**
     * Função que edita os dados
     */
    public function Edita() {

        $campoId = "id_" . $this->obj->getTabela();
        $sql = "UPDATE " . $this->obj->getTabela() . " SET ";

        $dbClass = new DB();

        $dbClass->Query($dbClass->Fields($this->obj->getTabela()));

        $ini = 1;
        $cont = $dbClass->NumRows();
        while ($dado = $dbClass->Fetch()) {
            $campo = $dado->Field;
            if ($campoId != $campo) {
                $campoGet = "get" . ucfirst($campo);

                if (is_null($this->obj->$campoGet()))
                    $sql .= $campo . " = NULL";
                else
                    $sql .= $campo . " = '" . (get_magic_quotes_gpc() == true ? $this->obj->$campoGet() : addslashes($this->obj->$campoGet())) . "'";

                if ($cont != $ini)
                    $sql .= ",";
            }
            $ini++;
        }
        $campoGet = "get" . ucfirst($campoId);
        $sql .= " WHERE " . $campoId . " = '" . $this->obj->$campoGet() . "'";

        //echo $sql;die;

        if (!$dbClass->Query($sql))
            throw new Exception('Falha ao editar os dados');
    }

    /**
     * Função que exclui os dados do banco
     */
    public function Exclui($codigo) {
        $codigo = (int) $codigo;

        $sql = "DELETE FROM " . $this->obj->getTabela() . " WHERE id_" . $this->obj->getTabela() . " = " . $codigo;
        $dbClass = new DB();

        if (!$dbClass->Query($sql))
            throw new Exception('Falha ao deletar os dados');
    }

}

?>
