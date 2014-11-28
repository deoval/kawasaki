<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("America/Sao_Paulo");
ini_set('allow_url_fopen', 1);

$pathRaiz = realpath(dirname(__FILE__));

if ($_SERVER['SERVER_NAME'] == "localhost") {
    ini_set('display_errors', '1');
    error_reporting(E_ERROR);
    define('DB_USER', 'appmobi_moto');
    define('DB_PASS', 'anb2014');
    define('DB_NAME', 'appmobi_moto');
    define('DB_HOST', 'appmobi.in');
} else {
    ini_set('display_errors', '0');
    define('DB_USER', 'appmobi_moto');
    define('DB_PASS', 'anb2014');
    define('DB_NAME', 'appmobi_moto');
    define('DB_HOST', 'appmobi.in');
}

$pathRaiz = str_replace('\\', '/', $pathRaiz);
if ($pathRaiz != $_SERVER['DOCUMENT_ROOT']) {
    $docRoot = $_SERVER['DOCUMENT_ROOT'];

    // Remove o DIRECTORY_SEPARATOR do final da string se tiver e o inclui
    $docRoot = rtrim($docRoot, '/') . '/';

    $PATH = str_replace($docRoot, '', $pathRaiz);

    // Remove o DIRECTORY_SEPARATOR do inicio da string se tiver e o inclui
    $PATH = '/' . ltrim($PATH, '/');
    // Remove o DIRECTORY_SEPARATOR do final da string se tiver e o inclui
    $PATH = rtrim($PATH, '/') . '/';
} else {
    $PATH = '/';
}

$_SESSION["CKFINDER"]["path"] = $PATH;

if (isset($_SERVER['REQUEST_SCHEME'])) {
    $protocol = $_SERVER['REQUEST_SCHEME'];
} else if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    $protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
} else {
    $protocol = 'http';

    if ($_SERVER["SERVER_PORT"] == 443) { // protocolo https
        $protocol .= 's';
    }
}

$urlSite = $_SERVER['SERVER_NAME'] . $PATH;
if (substr($urlSite, -1) != '/')
    $urlSite = substr($urlSite, 0, strlen($urlSite) - 1);
define("URLSITE", $urlSite);

//echo "server=".$_SERVER['SERVER_NAME'];
define('GLOBAL_PATH', $protocol . '://' . $_SERVER['SERVER_NAME'] . $PATH);

if ($_SERVER['SERVER_PORT'] == '8080') {
    $PATH2 = preg_replace('%:8080%', '', $PATH);
    define('LOCAL_PATH', $_SERVER['DOCUMENT_ROOT'] . $PATH2);
} else {
    define('LOCAL_PATH', $_SERVER['DOCUMENT_ROOT'] . $PATH);
}

define("ADMIN_PATH", GLOBAL_PATH . "admin/");
define("CLASSE_PATH", LOCAL_PATH . "_class/"); //classes
define("APPLICATION", LOCAL_PATH . "admin/application/"); // diretorio de aplicação do admin
define("ADMIN_IMG", GLOBAL_PATH . 'admin/_assets/images/');
define('LOCAL_ARQ', LOCAL_PATH . '_assets/arquivos/');
define('ANDAMENTO', LOCAL_PATH . '_assets/img/timelapse/');
define("GLOBAL_ARQ", GLOBAL_PATH . '_assets/arquivos/');
define('LOCAL_LOG', LOCAL_PATH . '_assets/logs/');
define("GLOBAL_LOG", GLOBAL_PATH . '_assets/logs/');
define('LOCAL_AJAX', LOCAL_PATH . '_assets/ajax/');
define("GLOBAL_AJAX", GLOBAL_PATH . 'ajax/');
define("LOCAL_IMG", LOCAL_PATH . '_assets/img/');
define("GLOBAL_IMG", GLOBAL_PATH . '_assets/img/');
define("GLOBAL_CSS", GLOBAL_PATH . '_assets/css/');
define("GLOBAL_JS", GLOBAL_PATH . '_assets/js/');

  // define('LOCAL_CLOUD', LOCAL_PATH . '_assets/cloud/');
  // define("GLOBAL_CLOUD", GLOBAL_PATH . '_assets/cloud/');

define("_DESENVOLVIDOPOR_", "");
define("_URL_DESENVOLVIDOPOR_", "");
define("_LOGO_DESENVOLVIDOPOR_", "logo.png");
define("_EMPRESA_", "MotoFrete");


$metaTags = array("
    description" => "",
    "keywords" => ", ",
    "title" => "Moto Frete",
    "facebook" => array(
        "title" => "Moto Frete",
        "url" => "https://www.google.com.br",
        "type" => "website",
        "image" => GLOBAL_IMG . "facebook.jpg",
        "description" => ""
    )
);


/* * ******** CLASSES ********** */

//setlocale(LC_ALL, 'pt_BR', 'ptb');

function __autoload($classe) {

    if (file_exists(CLASSE_PATH . "padrao/" . $classe . ".php"))
        require_once(CLASSE_PATH . "padrao/" . $classe . ".php");
    else if (file_exists(CLASSE_PATH . "cielo/" . $classe . ".php"))
        require_once(CLASSE_PATH . "cielo/" . $classe . ".php");
    else if (file_exists(CLASSE_PATH . "util/" . $classe . ".php"))
        require_once(CLASSE_PATH . "util/" . $classe . ".php");
    else if (file_exists(CLASSE_PATH . "phpmailer/" . $classe . ".php"))
        require_once(CLASSE_PATH . "phpmailer/" . $classe . ".php");
    else {
        $erro = 0;

        // esse seria o "handler" do diretório
        $aplications = opendir(APPLICATION);

        // loop que busca todos os arquivos até que não encontre mais nada
        while (false !== ($directory = readdir($aplications))) {
            $dir = explode(".", $directory);
            if ($dir[0] != "") {
                //echo APPLICATION . $dir[0] . '/class/' . $classe . '.php<br />';
                //see if the file exsists
                if (file_exists(APPLICATION . $dir[0] . '/class/' . $classe . '.php')) {
                    $erro = 0;
                    require_once(APPLICATION . $dir[0] . '/class/' . $classe . '.php');
                    return;
                } else
                    $erro = 1;
            }
        }

        if ($erro == 1)
            die("Erro ao acessar a classe " . $classe);
    }
}