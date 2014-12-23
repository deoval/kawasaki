<?php
session_start();

include_once("inc_config.php");
require "site/vendor/autoload.php";
require "site/config/database.php";
require_once("_class/entidade/SqlMotoboy.php");

try {


    if (isset($_POST['cmd']) && $_POST['cmd'] == 'login') { 

        if (SqlCliente::_login($_POST['user'], $_POST['senha'])) {
            //echo 'Login realizado com sucesso.';
            echo '<script language= "JavaScript">location.href="' . GLOBAL_PATH . 'busca"</script>';
        } else {
		
			
            throw new Exception('Usuário ou senha incorretos!');
			
        }
        die;
    }
	
	 if (isset($_POST['cmd']) && $_POST['cmd'] == 'logout') { 
		SqlCliente::_logout();
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

        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 
        $validacao = "";
 
        for($count= 0; 20 > $count; $count++){
            //Gera um caracter aleatorio
            $validacao.= $basic[rand(0, strlen($basic) - 1)];
        }
 
        $_POST['cliente']["cod_verificacao"] = $validacao;

        $objCliente->Prepare($_POST['cliente']);
        if (!$_POST['cliente']['id_cliente']) {
            $objCliente->Cadastra();



            $content = http_build_query(array(
                'email' => $objCliente->email,
                'nome' => $objCliente->nome,
                'cod' => $objCliente->cod_verificacao,
            ));
              
            $context = stream_context_create(array(
                'http' => array(
                    'method'  => 'POST',
                    'content' => $content,
                )
            ));
              
            $result = file_get_contents( GLOBAL_PATH . 'ativacao.php', null, $context);

        } else {
            $objCliente->Edita();
        }

        echo 'Seu cadastro foi salvo com sucesso. Acesse seu email para efetuar a ativação.';
        //echo '<script language= "JavaScript">location.href="' . GLOBAL_PATH . 'busca"</script>';
		echo '<br/><a href="' . GLOBAL_PATH . '">Voltar</a>';
        die;
    }
    
    if (isset($_POST['cmd']) && $_POST['cmd'] == 'salvarMotoboy') {
        

		$target_dir_foto = "uploads/foto_motoboy/";
		$target_file_foto = $target_dir_foto . basename($_FILES["foto"]["name"]);
		$uploadOk_foto = 1;
		$imageFileType_foto = pathinfo($target_file_foto,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$checkimage_foto = getimagesize($_FILES["foto"]["tmp_name"]);
		
		
		$target_dir_cnh = "uploads/copia_cnh/";
		$target_file_cnh = $target_dir_cnh . basename($_FILES["cnh"]["name"]);
		$uploadOk_cnh = 1;
		$imageFileType_cnh = pathinfo($target_file_cnh,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$checkimage_cnh = getimagesize($_FILES["cnh"]["tmp_name"]);



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
		
		$_POST['motoboy']["imagem"] = $_FILES["foto"]["name"];
		$_POST['motoboy']["copia_cnh"] = $_FILES["cnh"]["name"];
		
        $objMotoboy->Prepare($_POST['motoboy']);

        if (!$_POST['motoboy']['id_motoboy']) {

			if($checkimage_foto !== false) {
				//echo "File is an image - " . $checkimage["mime"] . ".";
				$uploadOk_foto = 1;
				move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file_foto);
			} 
			else {
				throw new Exception("O arquivo escolhido para foto não é uma imagem válida.");
				$uploadOk_foto = 0;
			}
			if($checkimage_cnh !== false) {
				//echo "File is an image - " . $checkimage_cnh["mime"] . ".";
				$uploadOk_cnh = 1;
				move_uploaded_file($_FILES["cnh"]["tmp_name"], $target_file_cnh);
			} 
			else {
				throw new Exception("O arquivo escolhido para cópia de CNH não é uma imagem válida.");
				$uploadOk_cnh = 0;
			}
			
			$objMotoboy->Cadastra();
        } else {
            $objMotoboy->Edita();
        }

        //echo 'Obrigado! O cadastro foi salvo com sucesso.';
        echo '<script language= "JavaScript">location.href="' . GLOBAL_PATH . '"</script>';
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
