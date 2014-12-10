<div id="fale-conosco" style="width:70%; height:100%; float:right; margin-top: 50px;" >

<?php
$session_nome = $_SESSION['site'][_EMPRESA_]['cliente']["nome"];
$nome = isset($session_nome) && !empty($session_nome) ? $session_nome : "";

$session_email = $_SESSION['site'][_EMPRESA_]['cliente']["email"];
$email = isset($session_email) && !empty($session_email) ? $session_email : "";
?>


<!DOCTYPE html>
<html>
    
    <body>
        
        <div class="main">

            <div class="container">


                <div class="row">

                    <div class="col-md-12">

                        <div class="widget stacked">

                            <div class="widget-header">
                                <h3>Contato</h3>
                            </div> <!-- /widget-header -->
                                <br>
                                <div class="widget-content">                
                   
                    				<h4>Telefones</h4>
                                        
                                    <p class="col-md-12">telefone1</p>
                    			    <p class="col-md-12">telefone2</p>
                    				<p class="col-md-12">telefone3</p>
                                </div>
                                        </br>
                                        <div class="widget-content">  
                                        <h4>Fale Conosco</h4>
                                        <form action="<?php echo GLOBAL_PATH; ?>_assets/ajax/contato.php" class="form-horizontal col-md-7" id="formContato" >
                                            
                                            <div class="form-group">                                            
                                                <label for="nome" class="col-md-4">Nome</label>
                                                <div class="col-md-8">
                                                    <input type="text" data-validate name="nome"  data placeholder="Name" value = "<?php echo $nome ?>">
                                                </div> <!-- /controls -->               
                                            </div> <!-- /control-group -->
                                            
                                            <div class="form-group">                                            
                                                <label for="email" class="col-md-4">Email</label>
                                                <div class="col-md-8">
                                                     <input type="text" data-validate name="email" placeholder="E-mail" value = "<?php echo $email ?>"> 
                                                </div> <!-- /controls -->               
                                            </div> <!-- /control-group -->

                                            <div class="form-group">                                            
                                                <label for="mensagem" class="col-md-4">Mensagem</label>
                                                <div class="col-md-8">
                                                    <textarea name="mensagem" id="" placeholder="Message"></textarea>
                                                </div> <!-- /controls -->               
                                            </div> <!-- /control-group -->                                          
                                           
                                            <input type="submit" class="btn btn-primary" value="ENVIAR">
                                        </form>
                                </div>
                
                        </div>           
                    </div> 
                </div>
            </div>
        </div>   
    </body>
</html>
</div>