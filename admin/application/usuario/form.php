<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = null;
$title = 'Usuários';
$titleIcon = 'icon-group';
$subtitle = (intval($objUsuario->id_usuario) > 0) ? 'Edição de Cadastro' : 'Novo Cadastro';


$id_usuario = isset($_GET['ID']) && intval($_GET['ID']) > 0 ? (int) $_GET['ID'] : 0;
$objUsuario = new SqlUsuario($id_usuario);
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

                                <form action="../usuario/controller.php" target="actionFrame" id="fUsuario" role="form" class="form-horizontal col-md-7" method="post" enctype="multipart/form-data" onsubmit="return Usuario.valida(this.id);">
                                    <input type="hidden" name="<?php echo $objUsuario->tabela; ?>[id_usuario]" id="id_usuario" value="<?php echo $objUsuario->id_usuario; ?>">
                                    <input type="hidden" name="cmd" id="cmd" value="salvar">
                                    <fieldset>

                                        <div class="form-group">											
                                            <label for="nome" class="col-md-4">Nome</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objUsuario->tabela; ?>[nome]" id="nome" value="<?php echo $objUsuario->nome; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="sobrenome" class="col-md-4">Sobrenome</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objUsuario->tabela; ?>[sobrenome]" id="sobrenome" value="<?php echo $objUsuario->sobrenome; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="email" class="col-md-4">E-mail</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objUsuario->tabela; ?>[email]" id="email" value="<?php echo $objUsuario->email; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="telefone" class="col-md-4">Telefone</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objUsuario->tabela; ?>[telefone]" id="telefone" value="<?php echo $objUsuario->telefone; ?>" data-mask="telefone">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <?php
                                            if ($objUsuario->data_nascimento != '' && $objUsuario->data_nascimento != NULL && $objUsuario->data_nascimento != '0000-00-00') {
                                                $objDataNascimento = new DataHora($objUsuario->data_nascimento . ' 00:00:00');
                                                $dataNascimento = $objDataNascimento->DataPortugues();
                                            } else {
                                                $dataNascimento = '';
                                            }
                                            ?>											
                                            <label for="data_nascimento" class="col-md-4">Data de nascimento</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objUsuario->tabela; ?>[data_nascimento]" id="data_nascimento" value="<?php echo $dataNascimento; ?>" data-mask="data">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <label class="col-md-4">Ativo</label>
                                            <div class="col-md-8">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="<?php echo $objUsuario->tabela; ?>[ativo]" id="ativoS" value="1" <?php echo $objUsuario->ativo == 1 ? 'checked="checked"' : ''; ?>>
                                                        Sim
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="<?php echo $objUsuario->tabela; ?>[ativo]" id="ativoN" value="0" <?php echo $objUsuario->ativo == 0 ? 'checked="checked"' : ''; ?>>
                                                        Não
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="id_usuario_perfil" class="col-md-4">Perfil</label>
                                            <div class="col-md-8">
                                                <select name="<?php echo $objUsuario->tabela; ?>[id_usuario_perfil]" id="id_usuario_perfil" class="form-control">
                                                    <?php
                                                    echo Componente::_options($objUsuario->_listaComboPerfil(), (string) $objUsuario->id_usuario_perfil);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">											
                                            <label for="usuario" class="col-md-4">Usuário</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objUsuario->tabela; ?>[usuario]" id="usuario" value="<?php echo $objUsuario->usuario; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="senha" class="col-md-4">Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="<?php echo $objUsuario->tabela; ?>[senha]" id="senha" maxlength="10">
                                                <p class="help-block">A senha deve ter no minimo 4 caracteres e no maximo 10.</p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="repetirSenha" class="col-md-4">Repetir Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="<?php echo $objUsuario->tabela; ?>[repetirSenha]" id="repetirSenha" maxlength="10">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn btn-primary">Save</button> <button type="button" onclick="document.location.href = '../usuario/main.php'" class="btn btn-default">Cancel</button>
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
        <script type="text/javascript">Usuario.loadForm();</script>
    </body>
</html>
