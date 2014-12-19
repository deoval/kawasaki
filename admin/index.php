<?php
session_start();

include_once("../inc_config.php");  //Configurações, defines, objetos e classes comuns


if (isset($_SESSION[_EMPRESA_]) && is_array($_SESSION[_EMPRESA_]["SYS"]) && isset($_SESSION[_EMPRESA_]["SYS"]["id_usuario"]) && $_SESSION[_EMPRESA_]["SYS"]["id_usuario"] > 0) {
    header('location: application/solicitacao/alocar.php');
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Amatriz - Painel Administrativo</title>
        <?php include('_assets/inc/head.php') ?>
        <link href="<?php echo ADMIN_PATH; ?>_assets/css/pages/signin.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <nav class="navbar navbar-inverse" role="navigation">

            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="javascript:;;"><img src="<?php echo ADMIN_PATH; ?>_assets/img/logoAmatriz.png" border="0" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">						
                            Painel Administrativo
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div> <!-- /.container -->
        </nav>



        <div class="account-container stacked">

            <div class="content clearfix">

                <form name="fLogin" id="fLogin">
                    <input name="cmd" id="cmd" type="hidden" value="login">

                    <h1>Logar</h1>

                    <p>&nbsp;</p>

                    <div class="login-fields">

                        <div class="field">
                            <label for="usuario">Usuário:</label>
                            <input type="text" id="usuario" name="usuario" value="" placeholder="Seu usuário ou e-mail" class="form-control input-lg username-field" />
                        </div> <!-- /field -->

                        <div class="field">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" value="" placeholder="Sua senha" class="form-control input-lg password-field"/>
                        </div> <!-- /password -->

                    </div> <!-- /login-fields -->

                    <div class="login-actions">

                        <span class="login-checkbox">
                            <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                            <label class="choice" for="Field">Lembrar-me</label>
                        </span>

                        <button class="login-action btn btn-primary">Entrar</button>

                    </div> <!-- .actions -->

                    <div class="login-social">

                        <!-- Text Under Box -->
                        <div class="login-extra">
                            <button class="btn btn-info">Lembrar Senha</button>
                        </div> <!-- /login-extra -->

                    </div>


                </form>

            </div> <!-- /content -->

        </div> <!-- /account-container -->



        <!-- scripts -->
        <script src="<?php echo ADMIN_PATH; ?>_assets/js/libs/jquery-1.9.1.min.js"></script>
        <script src="<?php echo ADMIN_PATH; ?>_assets/js/libs/jquery-ui-1.10.0.custom.min.js"></script>
        <script src="<?php echo ADMIN_PATH; ?>_assets/js/libs/bootstrap.min.js"></script>

        <script src="<?php echo ADMIN_PATH; ?>_assets/js/Application.js"></script>

        <script src="<?php echo ADMIN_PATH; ?>_assets/js/componente/signin.js"></script>

    </body>
</html>