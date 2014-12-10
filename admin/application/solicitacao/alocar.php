<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão
include( LOCAL_PATH . 'site/vendor/autoload.php');
include( LOCAL_PATH . 'site/config/database.php');

$menu = 6;
$title = 'Solicitações';
$titleIcon = 'icon-inbox';

$motoboys = MotoboyE::all();

if (isset($_POST['filtro']) && $_POST['filtro'] != '' ) {
  $filtro = $_POST['filtro'];  
  $solicitacoes = SolicitacaoE::join('cliente as c', 's.id_cliente', '=', 'c.id_cliente')
->join( 'solicitacao_endereco as seb', 'seb.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_busca')
->join( 'solicitacao_endereco as see', 'see.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_entrega')
->from('solicitacao as s')
->select('c.nome as cliente', 's.id_solicitacao as id',
'seb.id_solicitacao_endereco as sendbusca_id', 'seb.endereco as enderecoa', 
'see.id_solicitacao_endereco as sendentrega_id' , 'see.endereco as enderecob')
->where('s.id_motoboy', '=', 0)
->where('c.nome', 'LIKE', '%'. $filtro .'%')
->get(); 
}
else{
  $solicitacoes = SolicitacaoE::join('cliente as c', 's.id_cliente', '=', 'c.id_cliente')
->join( 'solicitacao_endereco as seb', 'seb.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_busca')
->join( 'solicitacao_endereco as see', 'see.id_solicitacao_endereco', '=', 's.id_solicitacao_endereco_entrega')
->from('solicitacao as s')
->select('c.nome as cliente', 's.id_solicitacao as id',
'seb.id_solicitacao_endereco as sendbusca_id', 'seb.endereco as enderecoa', 
'see.id_solicitacao_endereco as sendentrega_id' , 'see.endereco as enderecob')
->where('s.id_motoboy', '=', 0)
->get();
}

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
                                            <div class="col-md-9">
                                                <input class="form-control form-search" name="filtro" type="text" placeholder="Pesquisar por cliente">
                                            </div>
                                            
                                        </div>
                                        
                                        <input type="submit" value="" style="visibility: hidden;" />
                                    </form>

                                    <table id="grid-cliente" class="grid-lista">
                                        <thead>
                                          <tr>
                                              <td class="col-md-4">Nome do cliente</td>
                                              <td class="col-md-2">Endereço de busca</td>
                                              <td class="col-md-2">Endereço de entrega</td>
                                              <td class="col-md-2">Ativo</td>
                                              <td class="col-md-2">Motoboy</td>
                                          </tr>  
                                        </thead>
                                        <tbody>
                                            <?php foreach ($solicitacoes as $key => $obj) { ?>
                                                <tr>
                                                  <td class="col-md-4"><?php echo $obj->cliente ?></td>
                                                  <td class="col-md-2"><?php echo $obj->enderecoa ?></td>
                                                  <td class="col-md-2"><?php echo $obj->enderecob ?></td>                                                  
                                                    <td class="col-md-2">
                                                        <select id="selectMotoboy<?php echo $obj->id ?>">
                                                          <?php foreach ($motoboys as $key => $value) {?>
                                                              
                                                          <option value="<?php echo $value->id_motoboy?>">
                                                            <?php echo $value->nome?>
                                                          </option>
                                                          
                                                          <?php } ?>
                                                        </select>  
                                                    </td>
                                                  <td class="col-md-2"><button id="alocar" class="btn" onclick="alocarMotoboy(<?php echo $obj->id ?>);">Alocar motoboy</button></td>  
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
        function alocarMotoboy(id) {
            var e = document.getElementById("selectMotoboy"+id);
            var itemSelecionado = e.options[e.selectedIndex].value;
            location.href='alocarMotoboy.php?id=' + id + '&motoboy=' + itemSelecionado;
        };    
        </script>
    </body>
</html>