<?php

include_once("../../../inc_config.php");
require_once("../../inc_start.php");  //Script de descontinuidade de sessão

/*
  Util::_verArray($_POST);
  echo "<br /><br />";
  Util::_verArray($_FILES);
  die();
 * 
 */

try {

//Ajustando para deletar multi registros
    if (isset($_POST["CMD"]) && $_POST["CMD"] == "multi-excluir") {
        $objCliente = new SqlCliente((int) $_REQUEST["id"]);

        if ($objCliente->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objCliente->imagem);
        }

        $objCliente->Exclui((int) $_REQUEST["id"]);

        exit();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'changeAtivo') {
        $objCliente = new SqlCliente((int) $_POST['id']);
        if ($_POST['action'] == true) {
            $objCliente->ativo = 1;
        } else {
            $objCliente->ativo = 0;
        }
        $objCliente->Edita();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'listar') {
        
        $db = new DB();

        //FILTROS
        $filtro = array();

        if (!Util::_isEmpty($_POST['filtro']['nome'])) {
            $_POST['filtro']['nome'] = preg_replace("& &", "%", $_POST['filtro']['nome']);
            $filtro[] = "(nome LIKE '%" . $_POST['filtro']['nome'] . "%' OR email LIKE '%" . $_POST['filtro']['nome'] . "%')";
        }

        $totalRegistros = SqlCliente::_totalRegistros($filtro);


        //INICIALIZA VARIAVEIS PARA PAGINAÇÃO
        $page = isset($_POST['page']) ? $_POST['page'] : 1; // pega a requisição da pagina
        $limit = isset($_POST['rows']) ? $_POST['rows'] == 'null' ? NULL : $_POST['rows'] : 10; // obter quantas linhas que queremos ter na grade
        $sidx = isset($_POST['sidx']) ? $_POST['sidx'] : 1; // obter linha de índice - ou seja, a coluna clicada pelo usuário para classificar
        $sord = isset($_POST['sord']) ? $_POST['sord'] : 'ASC'; // obter o sentido

        if (!is_null($limit)) {
            $objPaginacao = new Paginacao($page, $limit, $totalRegistros, 5);

            if ($page > $objPaginacao->getTotal_paginas())
                $objPaginacao = new Paginacao($objPaginacao->getTotal_paginas(), $limit, $totalRegistros, 5);

            $listLimit = $objPaginacao->getLimit();
            $totalPages = $objPaginacao->getTotal_paginas();
            $pages = $objPaginacao->geraPaginacao();
        } else {
            $listLimit = NULL;
            $totalPages = 1;
            $pages = NULL;
        }

        $arrayCliente = SqlCliente::_lista($filtro, $listLimit, $sidx . " " . $sord);

        $response = array(
            'page' => $page,
            'totalPages' => $totalPages,
            'records' => $totalRegistros,
            'pages' => $pages,
            'pageRows' => $limit
        );
        
        if ($totalRegistros > 0) {
            foreach ($arrayCliente as $aCliente) {
                if($aCliente['ativo'] == 1) {
                    $ativoClass = 'on';
                    $ativoText = 'Sim';
                } else {
                    $ativoClass = 'off';
                    $ativoText = 'Não';
                }
                    
                $response['rows'][] = array(
                    "id" => $aCliente['id_cliente'],
                    "cell" => array(
                        $aCliente['nome'],
                        $aCliente['email'],
                        $aCliente['telefone'],
                        '<div class="slider-frame primary">'
                            . '<span data-on-text="Sim" data-off-text="Não" class="slider-button ativo '.$ativoClass.'">'.$ativoText.'</span>'
                        . '</div>',
                    )
                );
            }
        }
        
        echo json_encode($response);
        
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

try {


//Exclui fotos, arquivos, e a propria públicação
    if (isset($_GET["cmd"]) && $_GET["cmd"] == "excluir") {
        $objCliente = new SqlCliente((int) $_GET["id"]);

        if ($objCliente->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objCliente->imagem);
        }

        $objCliente->Exclui((int) $_GET["id"]);
        Util::_jsCall("
            parent.Cliente.closeForm(" . (int) $_GET["id"] . ");
        ");

        exit();
    }


//Ajustado para cadastro ou edição
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvar') {

        if (!Util::_isEmpty($_POST['cliente']["email"]) && SqlCliente::_checkEmail($_POST['cliente']["email"], $_POST['cliente']['id_cliente']) > 0)
            throw new Exception('Este e-mail já existe em nossa base!');

        if (!Util::_isEmpty($_POST['cliente']["cpf"]) && SqlCliente::_checkCpf($_POST['cliente']["cpf"], $_POST['cliente']['id_cliente']) > 0)
            throw new Exception('Este cpf já existe em nossa base!');

        if (!(Util::_isEmpty($_POST['cliente']["cnpj"])) && SqlCliente::_checkCnpj($_POST['cliente']["cnpj"], $_POST['cliente']['id_cliente']) > 0)
            throw new Exception('Este cnpj já existe em nossa base!');

        $objCliente = new SqlCliente((int) $_POST['cliente']['id_cliente']);

        $senhaBkp = $_POST['cliente']["senha"] != "" ? md5($_POST['cliente']["senha"]) : $objCliente->senha;
        $_POST['cliente']["senha"] = $senhaBkp;

        $objCliente->Prepare($_POST['cliente']);

        if (!isset($_POST['cliente']["ativo"]))
            $objCliente->ativo = 0;

        if (!$_POST['cliente']['id_cliente'])
            $objCliente->Cadastra();
        else
            $objCliente->Edita();

        Util::_jsCall("
            parent.alert('O cadastro foi salvo com sucesso.');
            parent.Cliente.closeForm(" . (int) $_POST['cliente']['id_cliente'] . ");
        ");
    }
} catch (Exception $e) {
    Util::_jsCall("
        parent.alert(\"" . $e->getMessage() . "\");
    ");
}
?>