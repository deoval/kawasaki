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
        $objCategoria = new SqlCategoria((int) $_REQUEST["id"]);

        $objCategoria->Exclui((int) $_REQUEST["id"]);

        exit();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'changeAtivo') {
        $objCategoria = new SqlCategoria((int) $_POST['id']);
        if ($_POST['action'] == true) {
            $objCategoria->ativo = 1;
        } else {
            $objCategoria->ativo = 0;
        }
        $objCategoria->Edita();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'listar') {
        
        $db = new DB();

        //FILTROS
        $filtro = array();

        if ($_POST['filtro']['nome'] != "") {
            $_POST['filtro']['nome'] = preg_replace("& &", "%", $_POST['filtro']['nome']);
            $filtro[] = "(nome LIKE '%" . $_POST['filtro']['nome'] . "%' OR custo_adicional LIKE '%" . $_POST['filtro']['nome'] . "%')";
        }

        $totalRegistros = SqlCategoria::_totalRegistros($filtro);


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

        $arrayCategoria = SqlCategoria::_lista($filtro, $listLimit, $sidx . " " . $sord);

        $response = array(
            'page' => $page,
            'totalPages' => $totalPages,
            'records' => $totalRegistros,
            'pages' => $pages,
            'pageRows' => $limit
        );
        
        if ($totalRegistros > 0) {
            foreach ($arrayCategoria as $aCategoria) {
                    
                $response['rows'][] = array(
                    "id" => $aCategoria['id_categoria'],
                    "cell" => array(
                        $aCategoria['nome'],
						"R$ " . $aCategoria['custo_adicional'],
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
        $objCategoria = new SqlCategoria((int) $_GET["id"]);

        if ($objCategoria->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objCategoria->imagem);
        }

        $objCategoria->Exclui((int) $_GET["id"]);
        Util::_jsCall("
            parent.Categoria.closeForm(" . (int) $_GET["id"] . ");
        ");

        exit();
    }


//Ajustado para cadastro ou edição
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvar') {
		$_POST['categoria']['custo_adicional']=str_replace(",",".",str_replace ( "." , "" , $_POST['categoria']['custo_adicional'] ));
        $objCategoria = new SqlCategoria((int) $_POST['categoria']['id_categoria']);

        $objCategoria->Prepare($_POST['categoria']);

        if (!$_POST['categoria']['id_categoria'])
            $objCategoria->Cadastra();
        else
            $objCategoria->Edita();

        Util::_jsCall("
            parent.alert('A categoria foi salva com sucesso.');
            parent.Categoria.closeForm(" . (int) $_POST['categoria']['id_categoria'] . ");
        ");
    }
} catch (Exception $e) {
    Util::_jsCall("
        parent.alert(\"" . $e->getMessage() . "\");
    ");
}
?>