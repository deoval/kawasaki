<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão
include( LOCAL_PATH . 'site/vendor/autoload.php');
include( LOCAL_PATH . 'site/config/database.php');

$menu = 6;
$title = 'Relatório - Cliente';
$titleIcon = 'icon-inbox';

$id_cliente = isset($_POST['cliente'])? $_POST['cliente'] : 0;  
$mes = isset($_POST['mes'])? $_POST['mes'] : 0;  

if ($id_cliente != 0 ) {
  $solicitacoes = SolicitacaoE::join('cliente as c', 's.id_cliente', '=', 'c.id_cliente')
->leftjoin( 'motoboy as m', 'm.id_motoboy', '=', 's.id_motoboy')
->join( 'solicitacao_endereco as seb', 'seb.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_busca')
->join( 'solicitacao_endereco as see', 'see.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_entrega')
->from('solicitacao as s')
->select('c.nome as cliente', 's.id_solicitacao as id', 'm.nome as motoboy',
'seb.id_solicitacao_endereco as sendbusca_id', 'seb.endereco as enderecoa', 'seb.numero as numeroa', 'seb.bairro as bairroa', 'seb.cidade as cidadea',
'see.id_solicitacao_endereco as sendentrega_id' , 'see.endereco as enderecob', 'see.numero as numerob', 'see.bairro as bairrob', 'see.cidade as cidadeb', 's.valor as valor', 's.data')
//->where('s.ativo', '=', 1)
->where('c.id_cliente', '=', $id_cliente)
->get();
}
else{
  $solicitacoes = SolicitacaoE::join('cliente as c', 's.id_cliente', '=', 'c.id_cliente')
->leftjoin( 'motoboy as m', 'm.id_motoboy', '=', 's.id_motoboy')
->join( 'solicitacao_endereco as seb', 'seb.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_busca')
->join( 'solicitacao_endereco as see', 'see.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_entrega')
->from('solicitacao as s')
->select('c.nome as cliente', 's.id_solicitacao as id', 'm.nome as motoboy',
'seb.id_solicitacao_endereco as sendbusca_id', 'seb.endereco as enderecoa', 'seb.numero as numeroa', 'seb.bairro as bairroa', 'seb.cidade as cidadea',
'see.id_solicitacao_endereco as sendentrega_id' , 'see.endereco as enderecob', 'see.numero as numerob', 'see.bairro as bairrob', 'see.cidade as cidadeb', 's.valor as valor', 's.data')
//->where('s.ativo', '=', 1)
->get();
}

$clientes = ClienteE::from('cliente')
->select('id_cliente', 'nome')
->where('ativo', '=', 1)
->get();
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?> :: Amatriz Admin</title>
        <?php include('../../_assets/inc/head.php') ?>        
    </head>
    <body>
        <?php
        include('../../_assets/inc/navbar.php');
        include('../../_assets/inc/menu.php');
        ?>
        <div class="main">

            <div class="container">


                <div class="row">

                    <div class="col-md-12">      		

                        <div class="widget stacked ">

                            <div class="widget-header">
                                <i class="<?php echo $titleIcon ?>"></i>
                                <h3><?php echo $title ?></h3>
                            </div> <!-- /.widget-header -->                            
                             
                              <div class="widget-content">
                              <br />
                              <section>

                                      <form class="form-horizontal col-md-4" id="filtroCliente" name="filtroCliente" method="POST">
                                        <div class="form-group">
                                            <div class="col-md-7" style="margin-bottom: 10px">
                                                <select name="cliente" class="form-control" >
													<option value="0">Selecione o cliente</option>
													<?php foreach ($clientes as $key => $objcliente){ ?>
														<option value="<?php echo $objcliente->id_cliente?>"><?php echo $objcliente->nome ?></option>
													<?php } ?>
												</select>
                                            </div>
											<div class="col-md-7" style="margin-bottom: 10px">
												<select name="mes" class="form-control" >
													<option value="0">Selecione o mês</option>
													<option value="1">janeiro</option>
													<option value="2">fevereiro</option>
													<option value="3">março</option>
													<option value="4">abril</option>
													<option value="5">maio</option>
													<option value="6">junho</option>
													<option value="7">julho</option>
													<option value="8">agosto</option>
													<option value="9">setembro</option>
													<option value="10">outubro</option>
													<option value="11">novembro</option>
													<option value="12">dezembro</option>
												</select>
											</div>
											<div class="col-md-7" style="margin-bottom: 10px">
												<input type="submit" name="btnmesok" class="animate btn btn-default" id="btnmesok" value="Ok"/>                                                                 
                      </div>
                                        </div>
                                    </form>       

                                    <table id="grid-cliente" class="grid-lista">
                                        <thead>
                                          <tr>
                                              <td class="col-md-1">Nome do cliente</td>
                                              <td class="col-md-3">Endereço de busca</td>
                                              <td class="col-md-3">Endereço de entrega</td>
											  <td class="col-md-2">Data</td>
                                              <td class="col-md-2">Valor</td>
                                              <td class="col-md-1">Motoboy</td>
                                          </tr>  
                                        </thead>
                                        <tbody>
                                            <?php foreach ($solicitacoes as $key => $obj) { 
													$local_busca= $obj->enderecoa  . ", " . $obj->numeroa . ", " . $obj->bairroa . ", " . $obj->cidadea;
													$local_entrega= $obj->enderecob  . ", " . $obj->numerob . ", " . $obj->bairrob . ", " . $obj->cidadeb;
													$data = new DateTime($obj->data);
													if ($mes !=0){
														$data_mes = $data->format('m');
														if($data_mes == $mes){ 
														?>
															<tr>
																<td class="col-md-1"><?php echo $obj->cliente ?></td>
																<td class="col-md-3"><?php echo $local_busca ?></td>
																<td class="col-md-3"><?php echo $local_entrega ?></td>                                                  
																<td class="col-md-2"><?php echo $data->format('d-m-Y H:i:s') ?></td>                                                  
																<td class="col-md-2"><?php echo "R$" . $obj->valor ?></td>
																<td class="col-md-1"><?php echo $obj->motoboy ?></td>                                                 
															</tr> 
                                            <?php 
															}
														} else{ ?>
															<tr>
																<td class="col-md-1"><?php echo $obj->cliente ?></td>
																<td class="col-md-3"><?php echo $local_busca ?></td>
																<td class="col-md-3"><?php echo $local_entrega ?></td>                                                  
																<td class="col-md-2"><?php echo $data->format('d-m-Y H:i:s') ?></td>                                                  
																<td class="col-md-2"><?php echo "R$" . $obj->valor ?></td>
																<td class="col-md-1"><?php echo $obj->motoboy ?></td>                                                 
															</tr> 														
														
														<?php
														}														
													}
											?>														
                                        </tbody>
                                    </table>


                                </section>
                            </div> <!-- /widget-content -->

                        </div> <!-- /widget -->

                    </div> <!-- /span12 -->

                </div> <!-- /row -->

            </div> <!-- /container -->

        </div> <!-- /main -->


        <!-- scripts -->
        <?php
        include ('../../_assets/inc/footer.php');
        include('../../_assets/inc/scripts.php')
        ?>

    </body>
</html>