<?php

include_once("../../../inc_config.php");
require_once("../../inc_start.php");  //Script de descontinuidade de sessão
include( LOCAL_PATH . 'site/vendor/autoload.php');
include( LOCAL_PATH . 'site/config/database.php');

if (isset($_GET['id']) && isset($_GET['motoboy'])) {
    $id = $_GET['id'];
    $motoboy = $_GET['motoboy'];
    $solicitacao = SolicitacaoE::find($id);
    $solicitacao->id_motoboy = $motoboy;    
    $solicitacao->save();    
}

header('Location: alocar.php');
exit;
?>
