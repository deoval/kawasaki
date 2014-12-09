<?php
	include_once("../inc_config.php");	
	session_start();
    session_unset();
    session_destroy();
	echo '<script language= "JavaScript">location.href="' . ADMIN_PATH . '"</script>';
?>