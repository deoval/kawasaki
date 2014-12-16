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
        $objConfig = new SqlConfig((int) $_REQUEST["id"]);

        $objConfig->Exclui((int) $_REQUEST["id"]);

        exit();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'changeAtivo') {
        $objConfig = new SqlConfig((int) $_POST['id']);
        if ($_POST['action'] == true) {
            $objConfig->ativo = 1;
        } else {
            $objConfig->ativo = 0;
        }
        $objConfig->Edita();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'listar') {
        
        $db = new DB();

        //FILTROS
        $filtro = array();

        if ($_POST['filtro']['nome'] != "") {
            $_POST['filtro']['nome'] = preg_replace("& &", "%", $_POST['filtro']['nome']);
            $filtro[] = "(item LIKE '%" . $_POST['filtro']['nome'] . "%' OR value LIKE '%" . $_POST['filtro']['nome'] . "%')";
        }

        $totalRegistros = SqlConfig::_totalRegistros($filtro);


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

        $arrayConfig = SqlConfig::_lista($filtro, $listLimit, $sidx . " " . $sord);

        $response = array(
            'page' => $page,
            'totalPages' => $totalPages,
            'records' => $totalRegistros,
            'pages' => $pages,
            'pageRows' => $limit
        );
        
        if ($totalRegistros > 0) {
            foreach ($arrayConfig as $aConfig) {
                    
                $response['rows'][] = array(
                    "id" => $aConfig['id_config'],
                    "cell" => array(
                        $aConfig['item'],
						$aConfig['descricao'],
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
    if (isset($_POST["cmd"]) && $_POST["cmd"] == "excluir") {
        $objConfig = new SqlConfig((int) $_POST["id"]);

        $objConfig->Exclui((int) $_POST["id"]);

        echo json_encode('ok');

    }


//Ajustado para cadastro ou edição
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvar') {

        $objConfig = new SqlConfig((int) $_POST['config']['id_config']);

        $objConfig->Prepare($_POST['config']);

        if (!$_POST['config']['id_config'])
            $objConfig->Cadastra();
        else
            $objConfig->Edita();

        Util::_jsCall("
            parent.alert('O cadastro foi salvo com sucesso.');
            parent.Config.closeForm(" . (int) $_POST['config']['id_config'] . ");
        ");
    }
} catch (Exception $e) {
    Util::_jsCall("
        parent.alert(\"" . $e->getMessage() . "\");
    ");
}
?>