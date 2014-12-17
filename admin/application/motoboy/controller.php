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
        $objMotoboy = new SqlMotoboy((int) $_REQUEST["id"]);

        if ($objMotoboy->imagem != "") {
            foreach ($arrayIMG as $arrIMG)
                @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objMotoboy->imagem);
        }

        $objMotoboy->Exclui((int) $_REQUEST["id"]);

        exit();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'changeAtivo') {
        $objMotoboy = new SqlMotoboy((int) $_POST['id']);
        if ($_POST['action'] == true) {
            $objMotoboy->ativo = 1;
        } else {
            $objMotoboy->ativo = 0;
        }
        $objMotoboy->Edita();
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'listar') {
        
        $db = new DB();

        //FILTROS
        $filtro = array();

        if ($_POST['filtro']['nome'] != "") {
            $_POST['filtro']['nome'] = preg_replace("& &", "%", $_POST['filtro']['nome']);
            $filtro[] = "(nome LIKE '%" . $_POST['filtro']['nome'] . "%' OR email LIKE '%" . $_POST['filtro']['nome'] . "%')";
        }

        $totalRegistros = SqlMotoboy::_totalRegistros($filtro);


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

        $arrayMotoboy = SqlMotoboy::_lista($filtro, $listLimit, $sidx . " " . $sord);

        $response = array(
            'page' => $page,
            'totalPages' => $totalPages,
            'records' => $totalRegistros,
            'pages' => $pages,
            'pageRows' => $limit
        );
        
        if ($totalRegistros > 0) {
            foreach ($arrayMotoboy as $aMotoboy) {
                if($aMotoboy['ativo'] == 1) {
                    $ativoClass = 'on';
                    $ativoText = 'Sim';
                } else {
                    $ativoClass = 'off';
                    $ativoText = 'Não';
                }
                    
                $response['rows'][] = array(
                    "id" => $aMotoboy['id_motoboy'],
                    "cell" => array(
                        Util::LS($aMotoboy['nome']),
                        Util::LS($aMotoboy['email']),
                        $aMotoboy['telefone'],
                        Util::LS($aMotoboy['placa']),
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
    if (isset($_POST["cmd"]) && $_POST["cmd"] == "excluir") {
        $objMotoboy = new SqlMotoboy((int) $_POST["id"]);


        $objMotoboy->Exclui((int) $_POST["id"]);


        echo json_encode('ok');
    }


//Ajustado para cadastro ou edição
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvar') {

       /*$_POST['motoboy'] = array(

        'email' => 't@t.com', 
        'cpf' => '21231321321', 
        'rg' => '15454213', 
        'placa' => 'kgk-1233',
         
        ); */


        if (Util::_isEmpty($_POST['motoboy']["email"]) 
            || Util::_isEmpty($_POST['motoboy']["cpf"]) 
            || Util::_isEmpty($_POST['motoboy']["rg"]) 
            || Util::_isEmpty($_POST['motoboy']["placa"]))
            throw new Exception('Os campos email, cpf, rg e placa não podem ser vazios');


        if (!Util::_isEmpty($_POST['motoboy']["email"]) && SqlMotoboy::_checkEmail($_POST['motoboy']["email"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Este e-mail já existe em nossa base!');

        if (!Util::_isEmpty($_POST['motoboy']["cpf"]) && SqlMotoboy::_checkCpf($_POST['motoboy']["cpf"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Este cpf já existe em nossa base!');

        if (!Util::_isEmpty($_POST['motoboy']["rg"]) && SqlMotoboy::_checkRg($_POST['motoboy']["rg"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Este rg já existe em nossa base!');

        if (!Util::_isEmpty($_POST['motoboy']["placa"]) && SqlMotoboy::_checkPlaca($_POST['motoboy']["placa"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Esta placa já existe em nossa base!');

        $objMotoboy = new SqlMotoboy((int) $_POST['motoboy']['id_motoboy']);
        
        $geo = geocode($_POST['motoboy']['endereco'].' '.$_POST['motoboy']['numero']. ' '.$_POST['motoboy']['bairro']);
        $_POST['motoboy']['endereco'] = $geo['endereco'];
        $_POST['motoboy']['numero'] = $geo['numero'];
        $_POST['motoboy']['bairro'] = $geo['bairro'];
        $_POST['motoboy']['cep'] = $geo['cep'];
        $_POST['motoboy']['lat'] = $geo['lat'];
        $_POST['motoboy']['lng'] = $geo['lng'];
        

        $senhaBkp = $_POST['motoboy']["senha"] != "" ? md5($_POST['motoboy']["senha"]) : $objMotoboy->senha;
        $_POST['motoboy']["senha"] = $senhaBkp;

        $_POST['motoboy']['data_nascimento'] = DataHora::DatePtToDateMysql($_POST['motoboy']['data_nascimento']);

        $objMotoboy->Prepare($_POST['motoboy']);
       

       if ($_FILES['imagem']['error'] == 0) {

            $ex = array_reverse(explode(".", $_FILES['imagem']['name']));

            if ($objMotoboy->imagem == "")
                $objMotoboy->imagem = md5(microtime()) . "." . $ex[0];
            else {
                foreach ($arrayIMG as $arrIMG) {
                    @unlink(LOCAL_ARQ . $arrIMG["prefix"] . $objMotoboy->imagem);
                }
                $objMotoboy->imagem = md5(microtime()) . "." . $ex[0];
            }
        }
        
        if (!isset($_POST['motoboy']["ativo"]))
            $objMotoboy->ativo = 0;

        if (!$_POST['motoboy']['id_motoboy'])
            $objMotoboy->Cadastra();
        else
            $objMotoboy->Edita();

        if ($_FILES['imagem']['error'] == 0) {
            $imageTransform = new ImageTransform();
            foreach ($arrayIMG as $arrIMG)
                $imageTransform->$arrIMG["t"]($_FILES['imagem']['tmp_name'], $arrIMG["w"], $arrIMG["h"], LOCAL_ARQ . $arrIMG["prefix"] . $objMotoboy->imagem);
        }

        Util::_jsCall("
            parent.alert('O cadastro foi salvo com sucesso.');
            parent.Motoboy.closeForm(" . (int) $_POST['motoboy']['id_motoboy'] . ");
        ");
    }
} catch (Exception $e) {
    Util::_jsCall("
        parent.alert(\"" . $e->getMessage() . "\");
    ");
}

function distancia($pontoA, $pontoB) {
    $json = file_get_contents('http://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $pontoA . '&destinations=' . $pontoB . '&mode=bicycling&language=pt-BR&sensor=false');
    $aJson = json_decode($json);

    return $aJson;
}

function geocode($endereco) {
    $endereco = preg_replace('& &', '+', $endereco);
    $json = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $endereco . '&language=pt-BR&sensor=true');
    $aJson = json_decode($json);
    
    if($aJson->status != 'OK') echo 'erro';//die('Erro');
    
    $dados = array (
        'numero' => $aJson->results[0]->address_components[0]->long_name,
        'endereco' => $aJson->results[0]->address_components[1]->long_name,
        'bairro' => $aJson->results[0]->address_components[2]->long_name,
        'cidade' => $aJson->results[0]->address_components[3]->long_name,
        'estado' => $aJson->results[0]->address_components[5]->long_name,
        'uf' => $aJson->results[0]->address_components[5]->short_name,
        'pais' => $aJson->results[0]->address_components[6]->short_name,
        'cep' => $aJson->results[0]->address_components[7]->long_name,
        'lat' => $aJson->results[0]->geometry->location->lat,
        'lng' => $aJson->results[0]->geometry->location->lng,
    );


    return $dados;
}
?>