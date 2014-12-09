<?php
session_start();
unset($_SESSION[iduser]);
echo '<script language= "JavaScript">location.href="' . GLOBAL_PATH . '"</script>';





?>