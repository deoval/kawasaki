<?php

session_start();

$gmtDate = gmdate("D, d M Y H:i:s");
header("Expires: {$gmtDate} GMT");
header("Last-Modified: {$gmtDate} GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");

include_once("../inc_config.php");
session_start();

try {

    if ($_POST["cmd"] == 'login') {
        if (SqlUsuario::_login($_POST["usuario"], $_POST['senha'])) {
            $data = array('error' => 0, 'message' => '');
            if ($_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] == 3) {
                $data['fabrica'] = 1;
            }
            echo json_encode($data);
        }
    }

    if ($_POST["cmd"] == 'logout') {
        session_unset();
        session_destroy();
        $data = array('error' => 0, 'message' => '');
        echo json_encode($data);
    }
} catch (Exception $e) {
    $data = array('error' => 1, 'message' => $e->getMessage());
    echo json_encode($data);
}
