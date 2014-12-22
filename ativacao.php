<?php
require "site/vendor/autoload.php";
require "site/config/database.php";
include_once('inc_config.php');
//session_start();
ob_start();
ini_set( 'display_errors', 0 );

if ($_GET['cod'] != '') {
	$cod =  $_GET['cod'];
	$clientev = ClienteE::where('cod_verificacao', '=', $cod)->get();
	foreach ($clientev as $key => $obj) {
		$id_cliente = $obj->id_cliente;
	}
	$cliente = ClienteE::find($id_cliente);
	if($cliente->id_cliente != null){
		$cliente->ativo = 1;
		$cliente->save();
		echo "Sua conta foi ativada. Efetue login para acessar a área do cliente.";
		echo '<br/><a href="' . GLOBAL_PATH . '">Ir para a Home</a>';
	}
	else{
		echo "Erro no código de verificacao";
		echo '<br/><a href="' . GLOBAL_PATH . '">Voltar</a>';
	}

}
else if(($_POST['email'] != '') and ($_POST['nome'] != '')){
	
	$nome =  $_POST['nome'];
	$email =  $_POST['email'];
	$cod =  $_POST['cod'];
	$link = GLOBAL_PATH . 'ativacao.php?cod=' . $cod;
	$corpo = '';
	$emailsender = 'CONTATO@PROATTITUDESERVICOS.COM.BR';
	$to = $email;
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $emailsender\r\n";
	$assunto = "Ative o seu cadastro - AMATRIZ";
	$corpo .= "Olá " . $nome . "<br />";
	$corpo .= "Clique no link abaixo para ativar seu cadastro em nosso site <br />";
	$corpo .= $link;
	
	if(!mail($to, $assunto, $corpo, $headers ,"-r".$emailsender)){ 
	    $headers .= "Return-Path: " . $emailsender . '\r\n'; 
	    mail($to, $assunto, $corpo, $headers );
		echo 'quase sucesso';
	} else {
		echo 'sucesso';
	}
	
}
else{
	echo 'Erro';			
}

?>