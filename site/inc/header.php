<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pro Attitude</title>
		<link rel="stylesheet" href="<?php echo GLOBAL_PATH; ?>_assets/css/bootstrap.css" />		
        <link rel="stylesheet" href="<?php echo GLOBAL_PATH; ?>_assets/css/main.css" />
        <script src="<?php echo GLOBAL_PATH; ?>bower_components/modernizr/modernizr.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="<?php echo GLOBAL_PATH; ?>_assets/js/bootstrap.js" type="text/javascript"></script>  
    </head>
    <body >
		<div class="navcontent">
        <nav class="navbar" role="navigation">
			<div class="wrapper wrapperHeight">
                <section class="top-bar-section">
                    <a href="<?php echo GLOBAL_PATH; ?>" class="logo"></a>
                    <div class="loginArea">
					<?php if( (!isset($_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"])) AND (!isset($_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"])) ){?>
                        <p>ÁREA DO CLIENTE</p>
                        <form action="<?php echo GLOBAL_PATH; ?>controller.php" name="fLogin" id="fLogin" method="post">
                            <input type="text" name="user" id="user" placeholder="Login"/>
                            <input type="password" name="senha" id="senha" placeholder="Senha"/>
                            <input type="hidden" name="cmd" id="comd" value="login"/> 
                            <input type="submit" name="btnLogin" id="btnLogin" value="OK"/> 
                        </form>
					<?php } else {?>
						<form action="<?php echo GLOBAL_PATH; ?>controller.php" name="fLogout" id="fLogout" method="post">
							<p>Olá, <?php echo $_SESSION['site'][_EMPRESA_]['cliente']["nome"]?>.</p>
                            <input type="hidden" name="cmd" id="comd" value="logout"/>
							<input type="button" name="btnOk" id="btnOk" onclick="location.href='busca';" value="Área do cliente" /> 
                            <input type="submit" name="btnLogout" id="btnLogout" value="Logout" style="width:50px"/> 
                        </form>
					<?php }?>	
                        <div class="clear"></div>
                        <span class="tel"></span> <p>(11) 2872-0062</p>
                        <span class="mail"></span> <a href="mailto:contato@proattitudeservicos.com.br">CONTATO@PROATTITUDESERVICOS.COM.BR</a>
                   		<p class="cadastre">Ainda não é cadastrado?</p> <p class="cadastre">Cadastre-se agora como <a class="cadastre" href="?p=cadcliente#cadcliente">Cliente</a> ou <a class="cadastre" href="?p=cadmotoboy#cadmotoboy">Motoboy</a></p>
                    </div>
                </section>
			</div>
			<div class="wrapper">
				<div class="navbar-header center-block">
					<button type="button" class="navbar-toggle" style="float: none;margin-left: 40%;" data-toggle="collapse" data-target="#bar1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>		
                <div class="collapse navbar-collapse bottom-bar-section" style="margin-left:4%;" id="bar1">
                    <ul class="nav navbar-nav navbar-left" >
                        <li><a href="<?php echo GLOBAL_PATH; ?>" >HOME</a></li>
                        <li><a href="?p=empresa#empresa">EMPRESA</a></li>
                        <li><a href="?p=servicos#servicos">SERVIÇOS</a></li>
                        <li><a href="#clientes">CLIENTES</a></li>
						<li><a href="#contato">CONTATO</a></li>
                    </ul>
                </div>
			</div>	
        </nav>
</div>
		
		
