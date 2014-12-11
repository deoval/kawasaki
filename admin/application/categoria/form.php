<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = null;
$title = 'Categorias';
$titleIcon = 'icon-cog';
$subtitle = (intval($objCategoria->id_categoria) > 0) ? 'Edição de Categoria' : 'Nova Categoria';


$id_categoria = isset($_GET['ID']) && intval($_GET['ID']) > 0 ? (int) $_GET['ID'] : 0;
$objCategoria = new SqlCategoria($id_categoria);
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
        include('../../_assets/inc/menu.php')
        ?>

        <div class="main">

            <div class="container">


                <div class="row">

                    <div class="col-md-12">

                        <div class="widget stacked">

                            <div class="widget-header">
                                <i class="<?php echo $titleIcon ?>"></i>
                                <h3><?php echo $title . ' - ' . $subtitle; ?></h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">

                                <form action="../categoria/controller.php" target="actionFrame" id="fCategoria" role="form" class="form-horizontal col-md-7" method="post" enctype="multipart/form-data" onsubmit="return Categoria.valida(this.id);">
                                    <input type="hidden" name="<?php echo $objCategoria->tabela; ?>[id_categoria]" id="id_categoria" value="<?php echo $objCategoria->id_categoria; ?>">
                                    <input type="hidden" name="cmd" id="cmd" value="salvar">
                                    <fieldset>

                                        <div class="form-group">											
                                            <label for="nome" class="col-md-4">Nome</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCategoria->tabela; ?>[nome]" id="nome" value="<?php echo $objCategoria->nome; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="custo_adicional" class="col-md-4">Custo Adicional</label>
                                            <div class="col-md-8">
                                                <input type="text" data-mask="moeda" class="form-control" name="<?php echo $objCategoria->tabela; ?>[custo_adicional]" id="custo_adicional" value="<?php echo str_replace(".",",",$objCategoria->custo_adicional); ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
										<div class="form-group">											
                                            <label for="custo_adicional" class="col-md-4">Disponível</label>
                                            <div class="col-md-8">
												<select class="form-control" name="<?php echo $objCategoria->tabela; ?>[disponivel]" id="disponivel" >
												<?php if($objCategoria->disponivel==0) {?>
													<option value="1">Sim</option>
													<option value="0" selected>Não</option>
												<?php
													}
													else 
													{
													?>
													<option value="1" selected>Sim</option>
													<option value="0">Não</option>
												<?php }?>
												</select>
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn btn-primary">Salvar</button> <button type="button" onclick="document.location.href = '../categoria/main.php'" class="btn btn-default">Cancelar</button>
                                            </div>
                                        </div>

                                    </fieldset>

                                </form>

                            </div> <!-- /widget-content -->

                        </div> <!-- /widget -->					

                    </div> <!-- /col-md-12 -->     	


                </div> <!-- /row -->

            </div> <!-- /container -->

        </div> <!-- /main -->




        <!-- scripts -->
        <?php
        include '../../_assets/inc/footer.php';
        include '../../_assets/inc/scripts.php';
        include '../../inc_util.php';
        ?>
        <script src="especific.js"></script>
        <script type="text/javascript">Categoria.loadForm();</script>
    </body>
</html>
