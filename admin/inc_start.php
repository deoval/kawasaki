<?php
$gmtDate = gmdate("D, d M Y H:i:s");    
header("Expires: {$gmtDate} GMT");    
header("Last-Modified: {$gmtDate} GMT");    
header("Cache-Control: no-cache, must-revalidate");    
header("Pragma: no-cache");

session_start();

//Verifica se o usário está logado
if(!isset($_SESSION[_EMPRESA_]) || !isset($_SESSION[_EMPRESA_]["SYS"]) || !($_SESSION[_EMPRESA_]["SYS"]["id_usuario"] > 0))
	header("Location: ../../?error=2");
	
?>