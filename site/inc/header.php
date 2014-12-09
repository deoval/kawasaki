<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pro Attitude</title>
        <link rel="stylesheet" href="<?php echo GLOBAL_PATH; ?>_assets/css/main.css" />
        <script src="<?php echo GLOBAL_PATH; ?>bower_components/modernizr/modernizr.js"></script>
    </head>
    <body >

        <nav class="top-bar" data-topbar>
            <div class="wrapper">
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
                   		<p class="cadastre">Ainda não é cadastrado?</p> <p class="cadastre">Cadastre-se agora como <a class="cadastre" href="<?php echo GLOBAL_PATH; ?>cad-cliente">Cliente</a> ou <a class="cadastre" href="<?php echo GLOBAL_PATH; ?>cad-motoboy">Motoboy</a></p>
                    </div>
                </section>
                <section class="bottom-bar-section">
                    <ul class="left">
                        <li><a href="<?php echo GLOBAL_PATH; ?>" class="ativo">HOME</a></li>
                        <li><a href="#">EMPRESA</a></li>
                        <li><a href="#">SERVIÇOS</a></li>
                        <li><a href="#">CLIENTES</a></li>
                    </ul>
                </section>
            </div>
        </nav>

