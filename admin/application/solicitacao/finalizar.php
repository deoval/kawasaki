<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão
include( LOCAL_PATH . 'site/vendor/autoload.php');
include( LOCAL_PATH . 'site/config/database.php');

$menu = 6;
$title = 'Solicitações';
$titleIcon = 'icon-inbox';

$solicitacoes = SolicitacaoE::join('cliente as c', 's.id_cliente', '=', 'c.id_cliente')
->join( 'motoboy as m', 'm.id_motoboy', '=', 's.id_motoboy')
->join( 'solicitacao_endereco as seb', 'seb.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_busca')
->join( 'solicitacao_endereco as see', 'see.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_entrega')
->from('solicitacao as s')
->select('c.nome as cliente', 's.id_solicitacao as id', 'm.nome as motoboy',
'seb.id_solicitacao_endereco as sendbusca_id', 'seb.endereco as enderecoa', 
'see.id_solicitacao_endereco as sendentrega_id' , 'see.endereco as enderecob')
->where('s.ativo', '=', 1)
->get();

$motoboys = MotoboyE::all();

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
                                    

                                    <table id="grid-cliente" class="grid-lista">
                                        <thead>
                                          <tr>
                                              <td class="col-md-4">Nome do cliente</td>
                                              <td class="col-md-2">Endereço de busca</td>
                                              <td class="col-md-2">Endereço de entrega</td>
                                              <td class="col-md-2">Motoboy</td>
                                              <td class="col-md-2">Ativo</td>
                                          </tr>  
                                        </thead>
                                        <tbody>
                                            <?php foreach ($solicitacoes as $key => $obj) { ?>
                                                <tr>
                                                  <td class="col-md-4"><?php echo $obj->cliente ?></td>
                                                  <td class="col-md-2"><?php echo $obj->enderecoa ?></td>
                                                  <td class="col-md-2"><?php echo $obj->enderecob ?></td>                                                  
                                                  <td class="col-md-2"><?php echo $obj->motoboy ?></td>                                                 
                                                   
                                                  <td class="col-md-2"><button id="finalizar" class="btn" onclick="finalizar(<?php echo $obj->id ?>);">Finalizar</button></td>  
                                                </tr> 
                                            <?php } ?>
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
        <script type="text/javascript">
        function finalizar(id) {            
            location.href='finalizarSolicitacao.php?id=' + id;
        };    
    
        </script>
    </body>
</html>