<?php
include_once("../../../inc_config.php");  //Institucionaluraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = 4;
$title = 'Textos';
$titleIcon = 'icon-quote-right';
$subtitle = (intval($objInstitucional->id_institucional) > 0) ? 'Edição de Cadastro' : 'Novo Cadastro';


$id_institucional = isset($_GET['ID']) && intval($_GET['ID']) > 0 ? (int) $_GET['ID'] : 0;
$objInstitucional = new SqlInstitucional($id_institucional);
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

                                <form action="../institucional/controller.php" target="actionFrame" id="fInstitucional" role="form" class="form-horizontal col-md-7" method="post" enctype="multipart/form-data" onsubmit="return Institucional.valida(this.id);">
                                    <input type="hidden" name="<?php echo $objInstitucional->tabela; ?>[id_institucional]" id="id_institucional" value="<?php echo $objInstitucional->id_institucional; ?>">
                                    <input type="hidden" name="cmd" id="cmd" value="salvar">
                                    <fieldset>

                                        <div class="form-group">											
                                            <label for="titulo" class="col-md-4">Titulo</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objInstitucional->tabela; ?>[titulo]" id="titulo" value="<?php echo $objInstitucional->titulo; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->


                                        <div class="form-group">											
                                            <label for="subtitulo" class="col-md-4">SubTitulo</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objInstitucional->tabela; ?>[subtitulo]" id="subtitulo" value="<?php echo $objInstitucional->subtitulo; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                         

                                        <div class="form-group">											
                                            <label for="texto" class="col-md-4">Texto</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control" rows="6" name="<?php echo $objInstitucional->tabela; ?>[texto]" id="texto"><?php echo $objInstitucional->texto; ?></textarea>
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn btn-primary">Save</button> <button type="button" onclick="document.location.href = '../institucional/main.php'" class="btn btn-default">Cancel</button>
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
        <script type="text/javascript">Institucional.loadForm();</script>
    </body>
</html>
