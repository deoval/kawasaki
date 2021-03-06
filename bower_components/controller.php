<?php
session_start();

include_once("inc_config.php");

try {


    if (isset($_POST['cmd']) && $_POST['cmd'] == 'login') { 

        if (SqlCliente::_login($_POST['user'], $_POST['senha'])) {
            echo 'Login realizado com sucesso.';
            echo '<br/><a href="' . GLOBAL_PATH . 'busca">Continuar</a>';
        } else {
            throw new Exception('Usuário ou senha incorretos!');
        }
        die;
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvarCliente') {

        if (!$_POST['cliente']['id_cliente'] && !$_POST['cliente']['termos']) {
            throw new Exception('Você precisa aceitar os termos!');
        }

        $objCliente = new SqlCliente((int) $_POST['cliente']['id_cliente']);
        $_POST['cliente']['id_cliente'] = (int) $objCliente->id_cliente;
        //$_POST['cliente']['data_nascimento'] = DataHora::DatePtToDateMysql($_POST['cliente']['data_nascimento']);

        if (SqlCliente::_checkEmail($_POST['cliente']["email"], $_POST['cliente']['id_cliente']) > 0)
            throw new Exception('Este e-mail já existe em nossa base!');

        if (!is_empty($_POST['cliente']["cpf"]) && SqlCliente::_checkCpf($_POST['cliente']["cpf"], $_POST['cliente']['id_cliente']) > 0)
            throw new Exception('Este cpf já existe em nossa base!');

        if (!is_empty($_POST['cliente']["cnpj"]) && SqlCliente::_checkCnpj($_POST['cliente']["cnpj"], $_POST['cliente']['id_cliente']) > 0)
            throw new Exception('Este cnpj já existe em nossa base!');

        $senhaBkp = $_POST['cliente']["senha"] != "" ? md5($_POST['cliente']["senha"]) : $objCliente->senha;
        $_POST['cliente']["senha"] = $senhaBkp;

        $objCliente->Prepare($_POST['cliente']);

        if (!$_POST['cliente']['id_cliente']) {
            $objCliente->Cadastra();

            $_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"] = $objCliente->id_cliente;
            $_SESSION['site'][_EMPRESA_]['cliente']["nome"] = $objCliente->nome;
            $_SESSION['site'][_EMPRESA_]['cliente']["email"] = $objCliente->email;
        } else {
            $objCliente->Edita();
        }

        echo 'O cadastro foi salvo com sucesso.';
        echo '<br/><a href="' . GLOBAL_PATH . 'busca">Continuar</a>';
        die;
    }
    
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvarMotoboy') {
        

        if (!$_POST['motoboy']['id_motoboy'] && !$_POST['motoboy']['termos']) {
            throw new Exception('Você precisa aceitar os termos!');
        }

        $objMotoboy = new SqlMotoboy((int) $_POST['motoboy']['id_motoboy']);
        $_POST['motoboy']['id_motoboy'] = (int) $objMotoboy->id_motoboy;
        $_POST['motoboy']['data_nascimento'] = DataHora::DatePtToDateMysql($_POST['motoboy']['data_nascimento']);

        if (SqlMotoboy::_checkEmail($_POST['motoboy']["email"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Este e-mail já existe em nossa base!');

        if (!is_empty($_POST['motoboy']["cpf"]) && SqlMotoboy::_checkCpf($_POST['motoboy']["cpf"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Este cpf já existe em nossa base!');

        if (!is_empty($_POST['motoboy']["rg"]) && SqlMotoboy::_checkRg($_POST['motoboy']["rg"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Este rg já existe em nossa base!');

        if (!is_empty($_POST['motoboy']["placa"]) && SqlMotoboy::_checkPlaca($_POST['motoboy']["placa"], $_POST['motoboy']['id_motoboy']) > 0)
            throw new Exception('Esta placa já existe em nossa base!');
        
        $geo = geocode($_POST['motoboy']['endereco'].' '.$_POST['motoboy']['numero']. ' '.$_POST['motoboy']['bairro']);
        $_POST['motoboy']['endereco'] = $geo['endereco'];
        $_POST['motoboy']['numero'] = $geo['numero'];
        $_POST['motoboy']['bairro'] = $geo['bairro'];
        $_POST['motoboy']['cep'] = $geo['cep'];
        $_POST['motoboy']['lat'] = $geo['lat'];
        $_POST['motoboy']['lng'] = $geo['lng'];

        $senhaBkp = $_POST['motoboy']["senha"] != "" ? md5($_POST['motoboy']["senha"]) : $objMotoboy->senha;
        $_POST['motoboy']["senha"] = $senhaBkp;

        $objMotoboy->Prepare($_POST['motoboy']);

        if (!$_POST['motoboy']['id_motoboy']) {
            $objMotoboy->Cadastra();
        } else {
            $objMotoboy->Edita();
        }

        echo 'Obrigado! O cadastro foi salvo com sucesso.';
        //echo '<br/><a href="' . GLOBAL_PATH . 'busca">Continuar</a>';
        die;
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo '<br/><a href="javascript:;;" onclick="window.history.back();">Voltar</a>';
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
    
    if($aJson->status != 'OK') die('Erro');
    
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

function is_empty($texto) {
    return (strlen(trim($texto))) ? TRUE : FALSE;
}
