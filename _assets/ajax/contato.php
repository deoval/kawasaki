<?php
//session_start();
ob_start();
if(($_POST['email'] != '') and ($_POST['nome'] != '') and ($_POST['destinatario'] != '')){
	
	$nome =  $_POST['nome'];
	$email =  $_POST['email'];
	$destinatario =  $_POST['destinatario'];
	$mensagem = $_POST['mensagem'];
	$corpo = '';
	$emailsender = $email;
	$to = $destinatario;
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $emailsender\r\n";
	$assunto = "NOVO CONTATO - AMATRIZ";
	$corpo .= "Nome: $nome<br />";
	$corpo .= "Email: $email<br />";
	$corpo .= "Mensagem: $mensagem<br />";
	
	if(!mail($to, $assunto, $corpo, $headers ,"-r".$emailsender)){ 
	    $headers .= "Return-Path: " . $emailsender . '\r\n'; 
	    mail($to, $assunto, $corpo, $headers );
		echo 'quase sucesso';
	} else {
		echo 'sucesso';
	}
	
}else{
	echo 'Preencha todos os campos obrigátorios!';			
}

?>