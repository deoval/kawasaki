<?php
session_start();

include_once("inc_config.php");

$ROUTS = array();
/* Exemplo de rota
  $ROUTS['produtos'] = 'categorias.php';
 * 
 */
$ROUTS['vende'] = 'imovel-interna.php?modalidade_id=1,2';
$ROUTS['aluga'] = 'imovel-interna.php?modalidade_id=3';

//gerenciamento das paginas
$exploParam = explode("/", GLOBAL_PATH);
$expTotal = sizeof($exploParam) - 1; // Subtrai um por causa da ultima barra na url
$expResult = $protocol . "://" . $_SERVER['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
$expResultT = explode("/", $expResult);

$urlGet = array();

if (sizeof($ROUTS)) {

    $isRout = FALSE;
    $expRouts = $expResultT;
    $expResultT_bkp = $expResultT;
    for ($i = 0; $i < $expTotal; $i++) {
        array_shift($expRouts);
    }

    $filePage = '';
    foreach ($expRouts as $key => $value) {
        $filePage .= '/' . $value;
        $filePage = ltrim(rtrim($filePage, '/'), '/');

        if (array_key_exists($filePage, $ROUTS)) {
            for ($i = 0; $i <= $key; ++$i) {
                $keyDel = $expTotal + $i;
                unset($expResultT_bkp[$keyDel]);
                array_shift($expRouts);
            }

            $routAliasExp = explode('/', $filePage);
            $routExp = explode('?', $ROUTS[$filePage]);
            $routGet = explode('&', end($routExp));
            $filePage = reset(explode('.', reset($routExp)));

            if (sizeof($routGet)) {
                foreach ($routGet as $get) {
                    $getExp = explode('=', $get);
                    $urlGet[$getExp[0]] = $getExp[1];
                }
            }
            unset($expResultT);
            $expResultT = array();
            $expResultT = $expResultT_bkp;

            $isRout = TRUE;
            break;
        }
    }


//parametros a serem usados
    if (!$isRout) {
        $filePage = $expResultT[$expTotal];
        unset($expResultT[$expTotal]);
    }
} else {
    $filePage = $expResultT[$expTotal];
    unset($expResultT[$expTotal]);
}
unset($expResultT_bkp);
$expResultT_bkp = $expResultT;
unset($expResultT);
$expResultT = array();

foreach ($expResultT_bkp as $value) {
    $expResultT[] = $value;
}

if (strpos($filePage, '?') !== false) {
    $filePage = explode('?', $filePage);
    $filePageGet = explode('&', end($filePage));
    $filePage = $filePage[0];

    if (sizeof($filePageGet)) {
        foreach ($filePageGet as $get) {
            $getExp = explode('=', $get);
            $urlGet[$getExp[0]] = $getExp[1];
        }
    }
}

// total de variaveis get
$totalGet = (isset($routAliasExp) && sizeof($routAliasExp)) ? (count($expRouts)) : (sizeof($expResultT)) - ($expTotal);

//regra valores
$varExt = '';
for ($i = 0; $i < $totalGet; $i++) {
    $varExt = $expResultT[$expTotal + $i];
    if (strlen(trim($varExt))) {
        if (strpos($varExt, '?') !== false) {
            $varExt = explode('?', $varExt);
            $varExtGet = explode('&', end($varExt));
            $varExt = $varExt[0];

            if (strlen(trim($varExt))) {
                array_push($urlGet, $varExt);
            }

            if (sizeof($varExtGet)) {
                foreach ($varExtGet as $get) {
                    $getExp = explode('=', $get);
                    $urlGet[$getExp[0]] = $getExp[1];
                }
            }
        } else {
            array_push($urlGet, $varExt);
        }
    }
}

if ($filePage != "") {
    if (file_exists("site/$filePage.php")) {
        include_once("site/$filePage.php");
    } else {
        include_once("site/error/404.php");
    }
} else {
    $filePage = 'home';
    include_once("site/$filePage.php");
}