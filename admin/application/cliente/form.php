<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = 7;
$title = 'Clientes';
$titleIcon = 'icon-group';
$subtitle = (intval($objCliente->id_cliente) > 0) ? 'Edição de Cadastro' : 'Novo Cadastro';


$id_cliente = isset($_GET['ID']) && intval($_GET['ID']) > 0 ? (int) $_GET['ID'] : 0;
$objCliente = new SqlCliente($id_cliente);
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

                                <form action="../cliente/controller.php" target="actionFrame" id="fCliente" role="form" class="form-horizontal col-md-7" method="post" enctype="multipart/form-data" onsubmit="return Cliente.valida(this.id);">
                                    <input type="hidden" name="<?php echo $objCliente->tabela; ?>[id_cliente]" id="id_cliente" value="<?php echo $objCliente->id_cliente; ?>">
                                    <input type="hidden" name="cmd" id="cmd" value="salvar">
                                    <fieldset>

                                        <div class="form-group">											
                                            <label for="nome" class="col-md-4">Nome</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[nome]" id="nome" value="<?php echo $objCliente->nome; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="email" class="col-md-4">E-mail</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[email]" id="email" value="<?php echo $objCliente->email; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="form-group">											
                                            <label for="cpf" class="col-md-4">Cpf</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[cpf]" id="cpf" value="<?php echo $objCliente->cpf; ?>" data-mask="cpf">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="form-group">											
                                            <label for="cnpj" class="col-md-4">Cnpj</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[cnpj]" id="cnpj" value="<?php echo $objCliente->cnpj; ?>" data-mask="cnpj">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
                                        <div class="form-group">											
                                            <label for="empresa" class="col-md-4">Empresa</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[empresa]" id="empresa" value="<?php echo $objCliente->empresa; ?>" data-mask="empresa">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->										

                                        <div class="form-group">											
                                            <label for="telefone" class="col-md-4">Telefone</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[telefone]" id="telefone" value="<?php echo $objCliente->telefone; ?>" data-mask="telefone">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->


                                        <div class="form-group">
                                            <label class="col-md-4">Ativo</label>
                                            <div class="col-md-8">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="<?php echo $objCliente->tabela; ?>[ativo]" id="ativoS" value="1" <?php echo $objCliente->ativo == 1 ? 'checked="checked"' : ''; ?>>
                                                        Sim
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="<?php echo $objCliente->tabela; ?>[ativo]" id="ativoN" value="0" <?php echo $objCliente->ativo == 0 ? 'checked="checked"' : ''; ?>>
                                                        Não
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">											
                                            <label for="senha" class="col-md-4">Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="<?php echo $objCliente->tabela; ?>[senha]" id="senha" maxlength="10">
                                                <p class="help-block">A senha deve ter no minimo 4 caracteres e no maximo 10.</p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="repetirSenha" class="col-md-4">Repetir Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="<?php echo $objCliente->tabela; ?>[repetirSenha]" id="repetirSenha" maxlength="10">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

										<div class="form-group">											
                                            <label for="endereco" class="col-md-4">Endereço</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[endereco]" id="endereco" value="<?php echo $objCliente->endereco; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
										<div class="form-group">											
                                            <label for="numero" class="col-md-4">Número</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[numero]" id="numero" value="<?php echo $objCliente->numero; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
										<div class="form-group">											
                                            <label for="complemento" class="col-md-4">Complemento</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[complemento]" id="complemento" value="<?php echo $objCliente->complemento; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
										<div class="form-group">											
                                            <label for="bairro" class="col-md-4">Bairro</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[bairro]" id="bairro" value="<?php echo $objCliente->bairro; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
										
										<div class="form-group">											
                                            <label for="cidade" class="col-md-4">Cidade</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[cidade]" id="cidade" value="<?php echo $objCliente->cidade; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
																				
										<div class="form-group">											
                                            <label for="cep" class="col-md-4">Cep</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objCliente->tabela; ?>[cep]" id="cep" value="<?php echo $objCliente->cep; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->										

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn btn-primary">Save</button> <button type="button" onclick="document.location.href = '../cliente/main.php'" class="btn btn-default">Cancel</button>
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
        <script type="text/javascript">Cliente.loadForm();</script>
    </body>
</html>
