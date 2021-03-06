<?php
include_once("../../../inc_config.php");  //Institucionaluraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = 4;
$title = 'Textos';
$titleIcon = 'icon-quote-right';
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
                                    <form class="form-horizontal col-md-4" id="filtroInstitucional" name="filtroInstitucional" onsubmit="Institucional.lista(0);return false">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <input class="form-control form-search" name="filtro[nome]" type="text" placeholder="Pesquisar...">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="rows" id="filtroRows" class="form-control form-search">
                                                    <option value="10" selected="">10</option>
                                                    <option value="30">30</option>
                                                    <option value="null">Todos</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="sidx" name="sidx" value="titulo"/>
                                        <input type="hidden" id="sord" name="sord" value="ASC"/>
                                        <input type="submit" value="" style="visibility: hidden;" />
                                    </form>
                                    
                                    <?php
                                    if ($_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] == 1) {
                                        ?>
                                        <div class="pull-right col-md-2">
                                            <a href="../institucional/form.php" class="btn btn-default">
                                                <i class="icon-plus"></i>
                                                Novo cadastro
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <table id="grid-institucional" class="grid-lista">
                                        <thead>
                                            <tr>
                                                <td class="col-md-10">Titulo</td>
                                                <td class="col-md-2">Edição</td>
                                            </tr>  
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>


                                </section>
                            </div> <!-- /widget-content -->

                        </div> <!-- /widget -->

                    </div> <!-- /span12 -->

                </div> <!-- /row -->

            </div> <!-- /container -->

        </div> <!-- /main -->

        <?php
        include '../../_assets/inc/footer.php';
        include '../../_assets/inc/scripts.php';
        include '../../inc_util.php';
        ?>
        <script src="especific.js"></script>
        <script type="text/javascript">Institucional.lista();</script>
    </body>
</html>