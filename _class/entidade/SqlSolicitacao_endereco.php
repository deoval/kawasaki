<?php

class SqlSolicitacao_endereco Extends SqlPadrao {

    protected $obj;

    public function __construct($id = 0, $encode = false) {
        $this->obj = new Solicitacao_endereco();

        $id = (int) $id;

        if ($id > 0)
            $this->Carrega($id, $encode);
        else
            $this->CarregaDefault();
    }

}

?>
