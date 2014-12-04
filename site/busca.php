<!doctype html>
<?php
require "vendor/autoload.php";
require "config/database.php";
$op = isset($urlGet['op']) && intval($urlGet['op']) > 0 ? (int) $urlGet['op'] : 0;
$op2 = isset($_POST['op']) && intval($_POST['op']) > 0 ? (int) $_POST['op'] : 0;
$cmd =isset($_POST['cmd']) ? $_POST['cmd'] : "";
//$_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"]=6;
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
        include('site/inc/menu.php');

			    if ($cmd == 'incluir_solicitacao') {

			
			
			$objsolicitacao_end_busca = new SqlSolicitacao_endereco((int) $_POST['end_solicita_busca']['id_solicitacao_endereco']);
			$_POST['end_solicita_busca']['id_solicitacao_endereco'] = (int) $objsolicitacao_end_busca->id_solicitacao_endereco;
			$objsolicitacao_end_busca->Prepare($_POST['end_solicita_busca']);
			
			if (!$_POST['end_solicita_busca']['id_solicitacao_endereco']){
				$objsolicitacao_end_busca->Cadastra();
			
			}
		    else
				$objsolicitacao_end_busca->Edita();
				
				
			$objsolicitacao_end_entrega = new SqlSolicitacao_endereco((int) $_POST['end_solicita_entrega']['id_solicitacao_endereco']);
			$_POST['end_solicita_entrega']['id_solicitacao_endereco'] = (int) $objsolicitacao_end_entrega->id_solicitacao_endereco;
			$objsolicitacao_end_entrega->Prepare($_POST['end_solicita_entrega']);
			if (!$_POST['end_solicita_entrega']['id_solicitacao_endereco'])
				$objsolicitacao_end_entrega->Cadastra();
				
		    else
				$objsolicitacao_end_entrega->Edita();					
		

			$objsolicitacao = new SqlSolicitacao((int) $_POST['solicitacao']['id_solicitacao']);
			$_POST['solicitacao']['id_solicitacao'] = (int) $objsolicitacao->id_solicitacao;
			$_POST['solicitacao']['id_solicitacao_endereco_busca']=(int) $objsolicitacao_end_busca->id_solicitacao_endereco;
			$_POST['solicitacao']['id_solicitacao_endereco_entrega']=(int) $objsolicitacao_end_entrega->id_solicitacao_endereco;
			$objsolicitacao->Prepare($_POST['solicitacao']);
			if (!$_POST['solicitacao']['id_solicitacao'])
				$objsolicitacao->Cadastra();
		    else
				$objsolicitacao->Edita();				
						
			
		}
		
		
			if ($op == 0 || $op2 == 1)
				include('inc/map-canvas.php');
			else if ($op == 1)
				include('inc/solicitacoes.php');
			else if ($op == 2)
				include('inc/solicitacoes2.php');
			else if ($op == 3)
				include('inc/meus-dados.php');
			else if ($op==4)
				include('inc/fale-conosco.php');			
			else
				include('inc/map-canvas.php');
			

		
		
       if ($cmd=="consultar") {
           $geoA = geocode($_POST['pontoa']['endereco'] . ' ' . $_POST['pontoa']['numero'] . ' ' . $_POST['pontoa']['bairro'] . ' ' . $_POST['pontoa']['cidade']);
           $geoB = geocode($_POST['pontob']['endereco'] . ' ' . $_POST['pontob']['numero'] . ' ' . $_POST['pontob']['bairro'] . ' ' . $_POST['pontob']['cidade']);
           $distancia = distancia($_POST['pontoa']['endereco'] . ' ' . $_POST['pontoa']['numero'] . ' ' . $_POST['pontoa']['bairro'] . ' ' . $_POST['pontoa']['cidade'], $_POST['pontob']['endereco'] . ' ' . $_POST['pontob']['numero'] . ' ' . $_POST['pontob']['bairro'] . ' ' . $_POST['pontob']['cidade']);
		   

		   		$busca_lat=$geoA['lat'];
				$busca_lng=$geoA['lng'];
				$busca_cep=$_POST['pontoa']['cep'];
				$busca_endereco=$_POST['pontoa']['endereco'];
				$busca_numero=$_POST['pontoa']['numero'];
				$busca_complemento=$_POST['pontoa']['complemento'];
				$busca_bairro=$_POST['pontoa']['bairro'];
				$busca_cidade=$_POST['pontoa']['cidade'];
				$busca_observacao=$_POST['pontoa']['observacao'];
				$busca_responsavel=$_POST['pontoa']['responsavel'];
				
				$entrega_lat=$geoB['lat'];
				$entrega_lng=$geoB['lng'];
				$entrega_cep=$_POST['pontob']['cep'];
				$entrega_endereco=$_POST['pontob']['endereco'];
				$entrega_numero=$_POST['pontob']['numero'];
				$entrega_complemento=$_POST['pontob']['complemento'];
				$entrega_bairro=$_POST['pontob']['bairro'];
				$entrega_cidade=$_POST['pontob']['cidade'];
				$entrega_observacao=$_POST['pontob']['observacao'];
				$entrega_responsavel=$_POST['pontob']['responsavel'];
				
				$solicitacao_id_cliente=$_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"];
				$solicitacao_id_motoboy;
				$solicitacao_id_solicitacao_endereco_busca;
				$solicitacao_id_solicitacao_endereco_entrega;
				$categ=$_POST['categ'];
				$solicitacao_data;
				$solicitacao_valor;
				$solicitacao_ativo;
		   
			
		   $objconfig = new Config();
		   $valor_km = (float)$objconfig->_lista(array(  item =>  "item = 'valor_quilometragem'"),"","")[0]['value'];
		   
		   $distancia_minima = (float)$objconfig->_lista(array(  item =>  "item = 'distancia_minima'"),"","")[0]['value'];

		   $distancia_sem_km = str_replace(" km", "", $distancia['distancia']);
		   $distancia_sem_km = (float)str_replace(",", ".", $distancia_sem_km);
		   
		   $objcategoria = Categoria::select('id_categoria','nome','custo_adicional')
		   ->from('categoria')
		   ->where('id_categoria','=',$categ)
		   ->get();
		   foreach ($objcategoria as $dado){
				$tipo_material = $dado->nome;
				$custo_adicional = $dado->custo_adicional;
		   }
		   
		   if ( $distancia_minima > $distancia_sem_km){
				$preco_servico = $distancia_minima * $valor_km;
		   }
		   else{
				$preco_servico = (int)$distancia_sem_km * (int)$valor_km;
		   }
		   $valor_total = $preco_servico + $custo_adicional;
			
        ?>
		 <div class="resultadoMotoboy">
        
            <h2>Resultado da Busca</h2>
            <table class="content" style="width: 100%;">
				<form action="<?php echo GLOBAL_PATH; ?>busca?op=1" name="fSolicitacao" id="fSolicitacao" method="post">
				
				<input type="hidden" name="cmd" id="comd" value="incluir_solicitacao"/>
				
				<input type="hidden" name="end_solicita_busca[lat]" id="lat" value="<?php echo $busca_lat ?>"/>
				<input type="hidden" name="end_solicita_busca[lng]" id="lng" value="<?php echo $busca_lng ?>"/>
				<input type="hidden" name="end_solicita_busca[cep]" id="cep" value="<?php echo $busca_cep ?>"/>
				<input type="hidden" name="end_solicita_busca[endereco]" id="endereco" value="<?php echo $busca_endereco ?>"/>
				<input type="hidden" name="end_solicita_busca[numero]" id="numero" value="<?php echo $busca_numero ?>"/>
				<input type="hidden" name="end_solicita_busca[complemento]" id="complemento" value="<?php echo $busca_complemento ?>"/>
				<input type="hidden" name="end_solicita_busca[bairro]" id="bairro" value="<?php echo $busca_cidade ?>"/>
				<input type="hidden" name="end_solicita_busca[cidade]" id="cidade" value="<?php echo $busca_cidade ?>"/>
				<input type="hidden" name="end_solicita_busca[observacao]" id="observacao" value="<?php echo $busca_observacao ?>"/>
				<input type="hidden" name="end_solicita_busca[responsavel]" id="responsavel" value="<?php echo $busca_responsavel ?>"/>
				
				<input type="hidden" name="end_solicita_entrega[lat]" id="lat" value="<?php echo $entrega_lat ?>"/>
				<input type="hidden" name="end_solicita_entrega[lng]" id="lng" value="<?php echo $entrega_lng ?>"/>
				<input type="hidden" name="end_solicita_entrega[cep]" id="cep" value="<?php echo $entrega_cep ?>"/>
				<input type="hidden" name="end_solicita_entrega[endereco]" id="endereco" value="<?php echo $entrega_endereco ?>"/>
				<input type="hidden" name="end_solicita_entrega[numero]" id="numero" value="<?php echo $entrega_numero ?>"/>
				<input type="hidden" name="end_solicita_entrega[complemento]" id="complemento" value="<?php echo $entrega_complemento ?>"/>
				<input type="hidden" name="end_solicita_entrega[bairro]" id="bairro" value="<?php echo $entrega_bairro ?>"/>
				<input type="hidden" name="end_solicita_entrega[cidade]" id="cidade" value="<?php echo $entrega_cidade ?>"/>
				<input type="hidden" name="end_solicita_entrega[observacao]" id="observacao" value="<?php echo $entrega_observacao ?>"/>
				<input type="hidden" name="end_solicita_entrega[responsavel]" id="responsavel" value="<?php echo $entrega_responsavel ?>"/>
				
				<input type="hidden" name="solicitacao[id_cliente]" id="id_cliente" value="<?php echo $solicitacao_id_cliente ?>"/>
				<input type="hidden" name="solicitacao[id_motoboy]" id="id_motoboy" value="2"/>
				<input type="hidden" name="solicitacao[id_solicitacao_endereco_busca]" id="id_solicitacao_endereco_busca" value=""/>
				<input type="hidden" name="solicitacao[id_solicitacao_endereco_entrega]" id="id_solicitacao_endereco_entrega" value=""/>
				<input type="hidden" name="solicitacao[id_categoria]" id="id_categoria" value="<?php echo $categ ?>"/>
				<input type="hidden" name="solicitacao[data]" id="data" value="<?php echo date("Y-m-d H:i:s") ?>"/>
				<input type="hidden" name="solicitacao[valor]" id="valor" value="<?php echo $valor_total ?>"/>
				<input type="hidden" name="solicitacao[ativo]" id="ativo" value="1"/>
				
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
                            <td>
                                Motoboy: <?php echo $dado->nome?><br/>
                                Distancia aproximada: <?php echo ($dado->DISTANCIA >= 1) ? number_format($dado->DISTANCIA, 1, ',', '.') . ' km' : floor($dado->DISTANCIA * 1000) . ' m';?>
                            </td>
							<td>
								<input type="submit" name="btnSolicitar" class="animate" id="btnSolicitar" value="Solicitar"/>
							</td>
                        </tr>
                        <?php
                    }
                }
                ?>
				<form>
			</table>
		
			<h2>Orçamento</h2>
            <table class="content" style="width: 100%;">
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
				<tr  colspan="2">  
					<td>
						Tipo de material: <?php echo $tipo_material ?> 
					</td>
				</tr>
				<tr  colspan="2">  
					<td>
						Preço do serviço: R$ <?php echo $preco_servico ?>

					</td>
				</tr>
				<tr  colspan="2">  
					<td>					
					Custo adicional: R$  <?php echo $custo_adicional ?>
					</td>
				</tr>
				<tr  colspan="2">  
					<td>					
					Valor total: R$  <?php echo $valor_total ?>
					</td>
				</tr>
                    
            </table>
        </div>	
				
        <?php
           }
		   
		      
       else{

        ?>
        <div class="buscaMotoboy">
            <form action="" name="fBusca" id="fBusca" method="post">
                <div>
                <h2>Local de Busca</h2>
                  <input type="text" name="pontoa[cep]" data-mask="cep" data-tipo="pontoa" placeholder="CEP:" value="<?php echo (is_array($geoA)) ? $geoA['cep'] : '' ?>"/>
                  <input type="text" name="pontoa[endereco]" id="pontoaEndereco" placeholder="Endereço:" value="<?php echo (is_array($geoA)) ? $geoA['endereco'] : '' ?>"/>
                  <input type="text" name="pontoa[numero]" data-mask="numero" placeholder="Número:" value="<?php echo (is_array($geoA)) ? $geoA['numero'] : '' ?>"/>
                  <input type="text" name="pontoa[bairro]" id="pontoaBairro" placeholder="Bairro" value="<?php echo (is_array($geoA)) ? $geoA['bairro'] : '' ?>"/>                  
                  <input type="text" name="pontoa[cidade]" id="pontoaCidade" placeholder="Cidade" value="<?php echo (is_array($geoA)) ? $geoA['cidade'] : '' ?>"/>
				  <input type="text" name="pontoa[responsavel]" placeholder="Responsavel:" value="<?php echo (is_array($_POST['pontoa'])) ? $_POST['pontoa']['responsavel'] : '' ?>"/>
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
				<div style="margin:auto;width: 50%;"> 
					
					<h2>Tipo de material:</h2>
					<select name="categ" class="form-control" >
					<option value="0">selecione</option>
					<?php 
					$categorias = Categoria::from('categoria')
					->select('id_categoria','nome')
					->get();
					
					foreach ($categorias as $dado){ ?>
						
						<option value="<?php echo $dado->id_categoria ?>"><?php echo $dado->nome ?></option>
					
					<?php }//Fechando foreach?>
					</select>
				</div>
                    <input type="hidden" name="cmd" id="comd" value="consultar"/>
					<input type="hidden" name="op" id="opcao" value="1"/>
                    <input type="submit" name="btnConsultar" class="animate" id="btnConsultar" value="Consultar"/>
            </form>
        </div>
		<?php
			}
        ?>
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