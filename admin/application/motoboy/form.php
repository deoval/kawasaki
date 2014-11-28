<?php
include_once("../../../inc_config.php");  //Configuraçõe, defines, objetos e classes comuns
include_once("../../inc_start.php");  //Script de descontinuidade de sessão

$menu = 9;
$title = 'Moto boy';
$titleIcon = 'icon-bicycle';
$subtitle = (intval($objMotoboy->id_motoboy) > 0) ? 'Edição de Cadastro' : 'Novo Cadastro';


$id_motoboy = isset($_GET['ID']) && intval($_GET['ID']) > 0 ? (int) $_GET['ID'] : 0;
$objMotoboy = new SqlMotoboy($id_motoboy);
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

                                <form action="../motoboy/controller.php" target="actionFrame" id="fMotoboy" role="form" class="form-horizontal col-md-7" method="post" enctype="multipart/form-data" onsubmit="return Motoboy.valida(this.id);">
                                    <input type="hidden" name="<?php echo $objMotoboy->tabela; ?>[id_motoboy]" id="id_motoboy" value="<?php echo $objMotoboy->id_motoboy; ?>">
                                    <input type="hidden" name="cmd" id="cmd" value="salvar">
                                    <fieldset>

                                        <div class="form-group">											
                                            <label for="nome" class="col-md-4">Nome</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[nome]" id="nome" value="<?php echo $objMotoboy->nome; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="email" class="col-md-4">E-mail</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[email]" id="email" value="<?php echo $objMotoboy->email; ?>">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <?php
                                            if ($objMotoboy->data_nascimento != '' && $objMotoboy->data_nascimento != NULL && $objMotoboy->data_nascimento != '0000-00-00') {
                                                $objDataNascimento = new DataHora($objMotoboy->data_nascimento . ' 00:00:00');
                                                $dataNascimento = $objDataNascimento->DataPortugues();
                                            } else {
                                                $dataNascimento = '';
                                            }
                                            ?>											
                                            <label for="data_nascimento" class="col-md-4">Data de nascimento</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[data_nascimento]" id="data_nascimento" value="<?php echo $dataNascimento; ?>" data-mask="data">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="telefone" class="col-md-4">Telefone</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[telefone]" id="telefone" value="<?php echo $objMotoboy->telefone; ?>" data-mask="telefone">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="clelular" class="col-md-4">Celular</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[celular]" id="celular" value="<?php echo $objMotoboy->celular; ?>" data-mask="telefone">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="cpf" class="col-md-4">Cpf</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[cpf]" id="cpf" value="<?php echo $objMotoboy->cpf; ?>" data-mask="cpf">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="rg" class="col-md-4">RG</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[rg]" id="rg" value="<?php echo $objMotoboy->rg; ?>" data-mask="rg">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="condumoto" class="col-md-4">Condumoto</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[condumoto]" id="condumoto" value="<?php echo $objMotoboy->condumoto; ?>" data-mask="condumoto">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="licenca" class="col-md-4">Licença</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[licenca]" id="licenca" value="<?php echo $objMotoboy->licenca; ?>" data-mask="licenca">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="placa" class="col-md-4">Placa</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[placa]" id="placa" value="<?php echo $objMotoboy->placa; ?>" data-mask="placa">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <hr/>
                                        
                                        <div class="form-group">											
                                            <label for="cep" class="col-md-4">Cep</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[cep]" id="cep" value="<?php echo $objMotoboy->cep; ?>" data-mask="cep">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="form-group">											
                                            <label for="endereco" class="col-md-4">Endereço</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[endereco]" id="endereco" value="<?php echo $objMotoboy->endereco; ?>" data-mask="">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="form-group">											
                                            <label for="numero" class="col-md-4">Número</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[numero]" id="numero" value="<?php echo $objMotoboy->numero; ?>" data-mask="numero">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="form-group">											
                                            <label for="complemento" class="col-md-4">Complemento</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[complemento]" id="complemento" value="<?php echo $objMotoboy->complemento; ?>" data-mask="">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="form-group">											
                                            <label for="bairro" class="col-md-4">Bairro</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[bairro]" id="bairro" value="<?php echo $objMotoboy->bairro; ?>" data-mask="">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <hr/>

                                        <div class="form-group">
                                            <label class="col-md-4">Ativo</label>
                                            <div class="col-md-8">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="<?php echo $objMotoboy->tabela; ?>[ativo]" id="ativoS" value="1" <?php echo $objMotoboy->ativo == 1 ? 'checked="checked"' : ''; ?>>
                                                        Sim
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="<?php echo $objMotoboy->tabela; ?>[ativo]" id="ativoN" value="0" <?php echo $objMotoboy->ativo == 0 ? 'checked="checked"' : ''; ?>>
                                                        Não
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">											
                                            <label for="senha" class="col-md-4">Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[senha]" id="senha" maxlength="10">
                                                <p class="help-block">A senha deve ter no minimo 4 caracteres e no maximo 10.</p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">											
                                            <label for="repetirSenha" class="col-md-4">Repetir Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="<?php echo $objMotoboy->tabela; ?>[repetirSenha]" id="repetirSenha" maxlength="10">
                                                <p class="help-block"></p>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-8">
                                                <button type="submit" class="btn btn-primary">Save</button> <button type="button" onclick="document.location.href = '../motoboy/main.php'" class="btn btn-default">Cancel</button>
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
        <script type="text/javascript">Motoboy.loadForm();</script>
    </body>
</html>
