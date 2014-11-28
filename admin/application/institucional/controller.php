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
        $objInstitucional = new SqlInstitucional((int) $_REQUEST["id"]);

        $objInstitucional->Exclui((int) $_REQUEST["id"]);

        exit();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'changeAtivo') {
        $objInstitucional = new SqlInstitucional((int) $_POST['id']);
        if ($_POST['action'] == true) {
            $objInstitucional->ativo = 1;
        } else {
            $objInstitucional->ativo = 0;
        }
        $objInstitucional->Edita();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'listar') {
        
        $db = new DB();

        //FILTROS
        $filtro = array();

        if ($_POST['filtro']['nome'] != "") {
            $_POST['filtro']['nome'] = preg_replace("& &", "%", $_POST['filtro']['nome']);
            $filtro[] = "(titulo LIKE '%" . $_POST['filtro']['nome'] . "%' OR texto LIKE '%" . $_POST['filtro']['nome'] . "%')";
        }

        $totalRegistros = SqlInstitucional::_totalRegistros($filtro);


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

        $arrayInstitucional = SqlInstitucional::_lista($filtro, $listLimit, $sidx . " " . $sord);

        $response = array(
            'page' => $page,
            'totalPages' => $totalPages,
            'records' => $totalRegistros,
            'pages' => $pages,
            'pageRows' => $limit
        );
        
        if ($totalRegistros > 0) {
            foreach ($arrayInstitucional as $aInstitucional) {
                    
                $response['rows'][] = array(
                    "id" => $aInstitucional['id_institucional'],
                    "cell" => array(
                        $aInstitucional['titulo'],
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
        $objInstitucional = new SqlInstitucional((int) $_GET["id"]);

        if ($objInstitucional->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objInstitucional->imagem);
        }

        $objInstitucional->Exclui((int) $_GET["id"]);
        Util::_jsCall("
            parent.Institucional.closeForm(" . (int) $_GET["id"] . ");
        ");

        exit();
    }


//Ajustado para cadastro ou edição
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvar') {

        $objInstitucional = new SqlInstitucional((int) $_POST['institucional']['id_institucional']);

        $objInstitucional->Prepare($_POST['institucional']);

        if (!$_POST['institucional']['id_institucional'])
            $objInstitucional->Cadastra();
        else
            $objInstitucional->Edita();

        Util::_jsCall("
            parent.alert('O cadastro foi salvo com sucesso.');
            parent.Institucional.closeForm(" . (int) $_POST['institucional']['id_institucional'] . ");
        ");
    }
} catch (Exception $e) {
    Util::_jsCall("
        parent.alert(\"" . $e->getMessage() . "\");
    ");
}
?>