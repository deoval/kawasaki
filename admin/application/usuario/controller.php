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

$arrayIMG[] = array("prefix" => "sys_", "w" => "110", "h" => "110", "t" => "crop");
$arrayIMG[] = array("prefix" => "list_", "w" => "55", "h" => "55", "t" => "crop");
$arrayIMG[] = array("prefix" => "tmb_", "w" => "133", "h" => "82", "t" => "crop");
$arrayIMG[] = array("prefix" => "or_", "w" => "3000", "h" => "3000", "t" => "resize");


try {

//Ajustando para deletar multi registros
    if (isset($_POST["CMD"]) && $_POST["CMD"] == "multi-excluir") {
        $objUsuario = new SqlUsuario((int) $_REQUEST["id"]);

        if ($objUsuario->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objUsuario->imagem);
        }

        $objUsuario->Exclui((int) $_REQUEST["id"]);

        exit();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'changeAtivo') {
        $objUsuario = new SqlUsuario((int) $_POST['id']);
        if ($_POST['action'] == true) {
            $objUsuario->ativo = 1;
        } else {
            $objUsuario->ativo = 0;
        }
        $objUsuario->Edita();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'listar') {
        
        $db = new DB();

        //FILTROS
        $filtro = array();

        if (intval($_POST['filtro']['id_usuario_perfil']) > 0)
            $filtro[] = "U.id_usuario_perfil = '" . $_POST['filtro']['id_usuario_perfil'] . "'";

        if ($_POST['filtro']['nome'] != "") {
            $_POST['filtro']['nome'] = preg_replace("& &", "%", $_POST['filtro']['nome']);
            $filtro[] = "(U.nome LIKE '%" . $_POST['filtro']['nome'] . "%' OR U.email LIKE '%" . $_POST['filtro']['nome'] . "%')";
        }

        if ($_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] > 1)
            $filtro[] = "U.id_usuario_perfil = '" . $_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] . "'";

        $totalRegistros = SqlUsuario::_totalRegistros($filtro);


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

        $arrayUsuario = SqlUsuario::_lista($filtro, $listLimit, $sidx . " " . $sord);

        $response = array(
            'page' => $page,
            'totalPages' => $totalPages,
            'records' => $totalRegistros,
            'pages' => $pages,
            'pageRows' => $limit
        );
        
        if ($totalRegistros > 0) {
            foreach ($arrayUsuario as $aUsuario) {
                if($aUsuario['ativo'] == 1) {
                    $ativoClass = 'on';
                    $ativoText = 'Sim';
                } else {
                    $ativoClass = 'off';
                    $ativoText = 'Não';
                }
                    
                $response['rows'][] = array(
                    "id" => $aUsuario['id_usuario'],
                    "cell" => array(
                        Util::LS($aUsuario['nome']),
                        Util::LS($aUsuario['email']),
                        $aUsuario['telefone'],
                        Util::LS($aUsuario['PERFIL']),
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
        $objUsuario = new SqlUsuario((int) $_GET["id"]);

        if ($objUsuario->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objUsuario->imagem);
        }

        $objUsuario->Exclui((int) $_GET["id"]);
        Util::_jsCall("
            parent.Usuario.closeForm(" . (int) $_GET["id"] . ");
        ");

        exit();
    }


//Ajustado para cadastro ou edição
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvar') {
        $_POST['usuario']["usuario"] = Util::_lowerCase($_POST['usuario']["usuario"]);

        if (SqlUsuario::_checkLogin($_POST['usuario']["usuario"], $_POST['usuario']['id_usuario']) > 0)
            throw new Exception('Este usuário já existe em nossa base!');

        if (SqlUsuario::_checkEmail($_POST['usuario']["email"], $_POST['usuario']['id_usuario']) > 0)
            throw new Exception('Este e-mail já existe em nossa base!');

        $objUsuario = new SqlUsuario((int) $_POST['usuario']['id_usuario']);

        $senhaBkp = $_POST['usuario']["senha"] != "" ? md5($_POST['usuario']["senha"]) : $objUsuario->senha;
        $_POST['usuario']["senha"] = $senhaBkp;

        $_POST['usuario']['data_nascimento'] = DataHora::DatePtToDateMysql($_POST['usuario']['data_nascimento']);

        $objUsuario->Prepare($_POST['usuario']);


        if ($_FILES['imagem']['error'] == 0) {

            $ex = array_reverse(explode(".", $_FILES['imagem']['name']));

            if ($objUsuario->imagem == "")
                $objUsuario->imagem = md5(microtime()) . "." . $ex[0];
            else {
                foreach ($arrayIMG as $arrIMG) {
                    @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objUsuario->imagem);
                }
                $objUsuario->imagem = md5(microtime()) . "." . $ex[0];
            }
        }

        if (!isset($_POST['usuario']["ativo"]))
            $objUsuario->ativo = 0;

        if (!$_POST['usuario']['id_usuario'])
            $objUsuario->Cadastra();
        else
            $objUsuario->Edita();

        if ($_FILES['imagem']['error'] == 0) {
            $imageTransform = new ImageTransform();
            foreach ($arrayIMG as $arrIMG)
                $imageTransform->$arrIMG["t"]($_FILES['imagem']['tmp_name'], $arrIMG["w"], $arrIMG["h"], LOCAL_ARQ . $arrIMG["prefix"] . $objUsuario->imagem);
        }

        Util::_jsCall("
            parent.alert('O cadastro foi salvo com sucesso.');
            parent.Usuario.closeForm(" . (int) $_POST['usuario']['id_usuario'] . ");
        ");
    }
} catch (Exception $e) {
    Util::_jsCall("
        parent.alert(\"" . $e->getMessage() . "\");
    ");
}
?>