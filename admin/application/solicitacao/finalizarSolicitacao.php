<?php

include_once("../../../inc_config.php");
require_once("../../inc_start.php");  //Script de descontinuidade de sessão
include( LOCAL_PATH . 'site/vendor/autoload.php');
include( LOCAL_PATH . 'site/config/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];   
    $solicitacao = SolicitacaoE::find($id);
    $solicitacao->ativo = 0;    
    $solicitacao->save();    
}

header('Location: finalizar.php');
exit;
?>
