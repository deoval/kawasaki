<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = 9;
$title = 'Moto boy';
$titleIcon = 'icon-bicycle';
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
                                    <form class="form-horizontal col-md-4" id="filtroMotoboy" name="filtroMotoboy" onsubmit="Motoboy.lista(0);return false">
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
                                        <input type="hidden" id="sidx" name="sidx" value="nome"/>
                                        <input type="hidden" id="sord" name="sord" value="ASC"/>
                                        <input type="submit" value="" style="visibility: hidden;" />
                                    </form>
                                    
                                    <div class="pull-right col-md-2">
                                        <a href="../motoboy/form.php" class="btn btn-default">
                                            <i class="icon-plus"></i>
                                            Novo cadastro
                                        </a>
                                    </div>



                                    <table id="grid-motoboy" class="grid-lista">
                                        <thead>
                                          <tr>
                                              <td class="col-md-2">Nome</td>
                                              <td class="col-md-2">E-mail</td>
                                              <td class="col-md-2">Telefone</td>
                                              <td class="col-md-2">Placa</td>
                                              <td class="col-md-2">Ativo</td>
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
        /*
        ?>

        <!-- main container -->
        <div class="content">

            <div id="pad-wrapper" class="users-list">

                <div class="row header">
                    <div class="box-add">
                        <h3><?php echo $title ?></h3>
                        <div class="pull-right">
                            <form class="form-search" id="filtroMotoboy" name="filtroMotoboy" onsubmit="Motoboy.lista(0);
                  return false">
                                <div class="col-md-6 field-box">
                                    <input class="search" name="filtro[nome]" type="text" placeholder="Pesquisar...">
                                </div>
                                <div class="col-md-4 field-box pull-right">
                                    <select name="rows" id="filtroRows" class="select-search">
                                        <option value="10" selected="">10</option>
                                        <option value="30">30</option>
                                        <option value="null">Todos</option>
                                    </select>
                                </div>
                                <input type="hidden" id="sidx" name="sidx" value="nome"/>
                                <input type="hidden" id="sord" name="sord" value="ASC"/>
                                <input type="submit" value="" style="visibility: hidden;" />
                            </form>
                            <a href="../motoboy/form.php" class="btn btn-default">
                                <i class="icon-plus"></i>
                                Novo cadastro
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-hover" id="grid-motoboy">
                        <thead>
                            <tr>
                                <th data-field="U.nome" class="col-md-3 sortable">
                                    Nome
                                </th>
                                <th data-field="U.email" class="col-md-3 sortable">
                                    <span class="line"></span> E-mail
                                </th>
                                <th data-field="U.telefone" class="col-md-2 sortable">
                                    <span class="line"></span> Telefone
                                </th>
                                <th data-field="PERFIL" class="col-md-2 sortable">
                                    <span class="line"></span> Perfil
                                </th>
                                <th data-field="U.ativo" class="col-md-1 sortable">
                                    <span class="line"></span> Ativo
                                </th>
                                <th class="col-md-1 sortable align-right">
                                    <span class="line"></span> Editar/Excluir
                                </th>
                            </tr>
                        </thead>
                        <tbody data-tabela="motoboy">
                            <!-- row -->
                            <!--SÃO 20 ITENS POR PÁGINA-->
                            <!--A ORDENAÇÃO DEVE SER POR DRAG-AND-DROP-->
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <span style="margin:0;position:relative;top:15px;color: #526273;font-family: 'Open Sans';font-size: 13px;" class="pull-left pagCont">

                    </span>
                    <ul class="pagination pull-right" id="pagination-motoboy">
                    </ul>
                </div>
                <!-- end users table -->
            </div>
        </div>
        <!-- end main container -->

        <!-- scripts -->
        <?php
        */
        include '../../_assets/inc/footer.php';
        include '../../_assets/inc/scripts.php';
        include '../../inc_util.php';
        ?>
        <script src="especific.js"></script>
        <script type="text/javascript">Motoboy.lista();</script>
    </body>
</html>