<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = null;
$title = 'Configurações';
$titleIcon = 'icon-cog';
$subtitle = (intval($objConfig->id_config) > 0) ? 'Edição de Cadastro' : 'Novo Cadastro';


$id_config = isset($_GET['ID']) && intval($_GET['ID']) > 0 ? (int) $_GET['ID'] : 0;
$objConfig = new SqlConfig($id_config);
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

                                <form action="../config/controller.php" target="actionFrame" id="fConfig" role="form" class="form-horizontal col-md-7" method="post" enctype="multipart/form-data" onsubmit="return Config.valida(this.id);">
                                    <input type="hidden" name="<?php echo $objConfig->tabela; ?>[id_config]" id="id_config" value="<?php echo $objConfig->id_config; ?>">
                                    <input type="hidden" name="cmd" id="cmd" value="salvar">
                                    <fieldset>

                                        <div class="form-group">											
                                            <label for="item" class="col-md-4">Item</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objConfig->tabela; ?>[item]" id="item" value="<?php echo $objConfig->item; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="value" class="col-md-4">Valor</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objConfig->tabela; ?>[value]" id="value" value="<?php echo $objConfig->value; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn btn-primary">Save</button> <button type="button" onclick="document.location.href = '../config/main.php'" class="btn btn-default">Cancel</button>
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
        <script type="text/javascript">Config.loadForm();</script>
    </body>
</html>
