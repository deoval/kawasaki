<nav class="navbar navbar-inverse" role="navigation">

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="icon-cog"></i>
            </button>
            <a class="navbar-brand" href="javascript:;;"><img src="<?php echo ADMIN_PATH; ?>_assets/img/logoAmatriz.png" border="0" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right" style="margin-top:15px;">
                
                <?php if ($_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] == 1) { ?>
                <li class="dropdown">
                    <a href="../dashboard/backup_banco.php" >
                        <i class="icon-download-alt"></i> 
                        Backup banco
                    </a>
                </li>
                <?php } ?>
                
                <li class="dropdown">
                    <a href="<?php echo GLOBAL_PATH ?>" >
                        <i class="icon-desktop"></i> 
                        Visitar site
                    </a>
                </li>
                
                <li class="dropdown">
                    <a href="../usuario/form.php?ID=<?php echo $_SESSION[_EMPRESA_]["SYS"]["id_usuario"]; ?>" >
                        <i class="icon-user"></i> 
                        Meus dados
                    </a>
                </li>
                
                <li class="dropdown">
                    <a href="../usuario/main.php" >
                    <!-- <a href="../usuario/main.php" class="dropdown-toggle" data-toggle="dropdown"> -->
                        <i class="icon-group"></i> 
                        Usuários
                    </a>
                </li>
                
                <li class="dropdown">
                    <a href="<?php echo ADMIN_PATH; ?>" >
                        <i class="icon-share-alt"></i>
                        Encerrar sessão
                    </a>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div> <!-- /.container -->
</nav>