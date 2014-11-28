<!doctype html>
<?php
$op = isset($urlGet['op']) && intval($urlGet['op']) > 0 ? (int) $urlGet['op'] : 0;
$op2 = isset($_POST['op']) && intval($_POST['op']) > 0 ? (int) $_POST['op'] : 0;
?>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Moto Fretes</title>
        <link rel="stylesheet" href="<?php echo GLOBAL_PATH; ?>_assets/css/main.css" />
		<link rel="stylesheet" href="<?php echo GLOBAL_PATH; ?>_assets/css/bootstrap.css" />
        <script src="<?php echo GLOBAL_PATH; ?>bower_components/modernizr/modernizr.js"></script>
    </head> 
    <body>

        <div class="buscaHeader">
            <img src="<?php echo GLOBAL_PATH; ?>_assets/img/logo.png" alt="">
            <h2 <?php if(is_array($_POST)){ ?> class="hide" <?php }?>>Preencha os campos abaixo, com o local de busca e entrega da mercadoria, que cuidamos do resto.</h2>
        </div>
		<?php
        include('_assets/inc/menu.php');
        ?>
		
		<?php
			if ($op == 0 || $op2 == 1)
				include('inc/map-canvas.php');
			else if ($op == 1)
				include('inc/solicitacoes.php');
			else if ($op == 2)
				include('inc/meus-dados.php');
			else if ($op == 3)
				include('inc/fale-conosco.php');
			
		?>
		
		
       <?php
       if (is_array($_POST) && count($_POST)) {
           $geoA = geocode($_POST['pontoa']['endereco'] . ' ' . $_POST['pontoa']['numero'] . ' ' . $_POST['pontoa']['bairro'] . ' ' . $_POST['pontoa']['cidade']);
           $geoB = geocode($_POST['pontob']['endereco'] . ' ' . $_POST['pontob']['numero'] . ' ' . $_POST['pontob']['bairro'] . ' ' . $_POST['pontob']['cidade']);
           $distancia = distancia($_POST['pontoa']['endereco'] . ' ' . $_POST['pontoa']['numero'] . ' ' . $_POST['pontoa']['bairro'] . ' ' . $_POST['pontoa']['cidade'], $_POST['pontob']['endereco'] . ' ' . $_POST['pontob']['numero'] . ' ' . $_POST['pontob']['bairro'] . ' ' . $_POST['pontob']['cidade']);
        ?>
    
        <div class="resultadoMotoboy">
            <h2>Resultado da Busca</h2>
            <table class="content" style="width: 100%;">
                <?php
                if (is_array($distancia)) {
                    ?>
                    <tr>
                        <td colspan="2">
                            Distância aproximada: <?php echo $distancia['distancia'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Tempo aproximado: <?php echo $distancia['tempo'] ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="2">
                        Motoboy's
                    </td>
                </tr>
                <?php
                if (is_array($geoA)) {
                    $lng = $geoA['lng'];
                    $lat = $geoA['lat'];
                    $db = new DB();
                    $db->setColuns("*, (acos(sin(radians(" . $lat . ")) * sin(radians(lat)) + cos(radians(" . $lat . ")) * cos(radians(lat)) * cos(radians(lng) - radians(" . $lng . "))) * 6378) as DISTANCIA");
                    $db->setFrom("motoboy");
                    $db->setHaving(" && DISTANCIA > 0");
                    $db->setOrder("DISTANCIA ASC");

                    //echo $db->Select();
                    
                    $db->Query($db->Select());

                    while ($dado = $db->Fetch()) {
                        ?>
                        <tr>
                            <td colspan="2">
                                Motoboy: <?php echo $dado->nome?><br/>
                                Distancia aproximada: <?php echo ($dado->DISTANCIA >= 1) ? number_format($dado->DISTANCIA, 1, ',', '.') . ' km' : floor($dado->DISTANCIA * 1000) . ' m';?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
        <?php
           }
        ?>
        <div class="buscaMotoboy">
            <form action="" name="fBusca" id="fBusca" method="post">
                <div>
                <h2>Local de Busca</h2>
                  <input type="text" name="pontoa[cep]" data-mask="cep" data-tipo="pontoa" placeholder="CEP:" value="<?php echo (is_array($geoA)) ? $geoA['cep'] : '' ?>"/>
                  <input type="text" name="pontoa[endereco]" id="pontoaEndereco" placeholder="Endereço:" value="<?php echo (is_array($geoA)) ? $geoA['endereco'] : '' ?>"/>
                  <input type="text" name="pontoa[numero]" data-mask="numero" placeholder="Número:" value="<?php echo (is_array($geoA)) ? $geoA['numero'] : '' ?>"/>
                  <input type="text" name="pontoa[bairro]" id="pontoaBairro" placeholder="Bairro" value="<?php echo (is_array($geoA)) ? $geoA['bairro'] : '' ?>"/>
                  <input type="text" name="pontoa[responsavel]" placeholder="Responsavel:" value="<?php echo (is_array($_POST['pontoa'])) ? $_POST['pontoa']['responsavel'] : '' ?>"/>
                  <input type="text" name="pontoa[cidade]" id="pontoaCidade" placeholder="Cidade" value="<?php echo (is_array($geoA)) ? $geoA['cidade'] : '' ?>"/>
                  <input type="text" class="obs" name="pontoa[observacao]" placeholder="Obs:" value="<?php echo (is_array($_POST['pontoa'])) ? $_POST['pontoa']['observacao'] : '' ?>"/>
                </div>
                <div>
                <h2>Local de Entrega</h2>
                    <input type="text" name="pontob[cep]" data-mask="cep" data-tipo="pontob" placeholder="CEP:" value="<?php echo (is_array($geoB)) ? $geoB['cep'] : '' ?>"/>
                    <input type="text" name="pontob[endereco]" id="pontobEndereco" placeholder="Endereço:" value="<?php echo (is_array($geoB)) ? $geoB['endereco'] : '' ?>"/>
                    <input type="text" name="pontob[numero]" data-mask="numero" placeholder="Número:" value="<?php echo (is_array($geoB)) ? $geoB['numero'] : '' ?>"/>
                    <input type="text" name="pontob[bairro]" id="pontobBairro" placeholder="Bairro" value="<?php echo (is_array($geoB)) ? $geoB['bairro'] : '' ?>"/>
                    <input type="text" name="pontob[cidade]" id="pontobCidade" placeholder="Cidade" value="<?php echo (is_array($geoA)) ? $geoA['cidade'] : '' ?>"/>
                    <input type="text" name="pontob[responsavel]" placeholder="Responsavel:" value="<?php echo (is_array($_POST['pontob'])) ? $_POST['pontob']['responsavel'] : '' ?>"/>
                    <input type="text" class="obs" name="pontob[observacao]" placeholder="Obs:" value="<?php echo (is_array($_POST['pontob'])) ? $_POST['pontob']['observacao'] : '' ?>"/>
                </div>
                    <input type="hidden" name="cmd" id="comd" value="buscar"/>
					<input type="hidden" name="op" id="opcao" value="1"/>
                    <input type="submit" name="btnBuscar" class="animate" id="btnBuscar" value="Solicitar"/>
            </form>
        </div>
    </body>
    <script src="<?php echo GLOBAL_PATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo GLOBAL_PATH; ?>bower_components/foundation/js/foundation.min.js"></script>
    <script src="<?php echo GLOBAL_PATH; ?>_assets/js/plugins.js"></script>
    <script src="<?php echo GLOBAL_PATH; ?>_assets/js/main.js"></script>

<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
    function initialize() {
        $geocoder = new google.maps.Geocoder();
        $directionsService = new google.maps.DirectionsService();
        $directionsDisplay = new google.maps.DirectionsRenderer();

        var mapOptions = {
            center: new google.maps.LatLng(-30.0277041, -51.228734599999996),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var $map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        
        var comoChegar = function ($lat, $lng) {

            /*
             if (typeof initialLocation === "undefined" && $("#search").val() == "") {
             alert("Preencha o endereço para traçar a rota!");
             return false;
             }
             */

            $directionsDisplay.setMap(null); // RESETA DIRECTION ANTERIOR
            $directionsDisplay.setMap($map);

            // $directionsDisplay.setPanel(document.getElementById("directions"));

            // document.getElementById("directions").innerHTML = "";
            // document.getElementById("directions").style.display = "block"

            //var $origin = codeAddress('Rua saldanha da gama 853, São José, Porto Alegre - RS');
            //var $destination = codeAddress('Rua portugal 423, São João, Porto Alegre - RS');
            //return false;

            $directionsService.route({
                origin: "<?php echo $_POST['pontoa']['endereco'] . ' ' . $_POST['pontoa']['numero'] . ' ' . $_POST['pontoa']['bairro'] . ' ' . $_POST['pontoa']['cidade'] ?>",
                destination: "<?php echo $_POST['pontob']['endereco'] . ' ' . $_POST['pontob']['numero'] . ' ' . $_POST['pontob']['bairro'] . ' ' . $_POST['pontob']['cidade'] ?>",
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            }, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK)
                    $directionsDisplay.setDirections(response);
            });
        };

        var codeAddress = function (address) {
            $geocoder.geocode({
                'address': address
            }, function (results, status) {
                    //console.log(results);
                if (status == google.maps.GeocoderStatus.OK) {
                    alert(results[0].geometry.location);
                    //map.setCenter(results[0].geometry.location);
                    //map.setZoom(14);
                    /*var marker = new google.maps.Marker({
                     map : map,
                     position : results[0].geometry.location
                     }); */
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
        <?php 
            if($geoA){
         ?>
        comoChegar(0,0);
        <?php } ?>
    }
     $('#map_canvas').height(document.innerHeight);
     initialize();
</script>
</html>       
<?php

function distancia($pontoA, $pontoB) {
    $pontoA = preg_replace('& &', '+', $pontoA);
    $pontoB = preg_replace('& &', '+', $pontoB);

    $json = file_get_contents('http://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $pontoA . '&destinations=' . $pontoB . '&mode=driving&language=pt-BR&sensor=false');
    $aJson = json_decode($json);

    if ($aJson->status != 'OK')
        die('Erro');

    $dados = array(
        'distancia' => $aJson->rows[0]->elements[0]->distance->text,
        'tempo' => $aJson->rows[0]->elements[0]->duration->text,
    );

    return $dados;
}

function geocode($endereco) {
    $endereco = preg_replace('& &', '+', $endereco);
    $json = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $endereco . '&language=pt-BR&sensor=true');
    $aJson = json_decode($json);

    if ($aJson->status != 'OK')
        die('Erro');

    $dados = array(
        'numero' => $aJson->results[0]->address_components[0]->long_name,
        'endereco' => $aJson->results[0]->address_components[1]->long_name,
        'bairro' => $aJson->results[0]->address_components[2]->long_name,
        'cidade' => $aJson->results[0]->address_components[3]->long_name,
        'estado' => $aJson->results[0]->address_components[5]->long_name,
        'uf' => $aJson->results[0]->address_components[5]->short_name,
        'pais' => $aJson->results[0]->address_components[6]->short_name,
        'cep' => $aJson->results[0]->address_components[7]->long_name,
        'lat' => $aJson->results[0]->geometry->location->lat,
        'lng' => $aJson->results[0]->geometry->location->lng,
    );


    return $dados;
}

function is_empty($texto) {
    return (strlen(trim($texto))) ? TRUE : FALSE;
}