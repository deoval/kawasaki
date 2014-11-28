<?php
$session_nome = $_SESSION['site'][_EMPRESA_]['cliente']["nome"];
$nome = isset($session_nome) && !empty($session_nome) ? $session_nome : "";

$session_email = $_SESSION['site'][_EMPRESA_]['cliente']["email"];
$email = isset($session_email) && !empty($session_email) ? $session_email : "";
?>

<div id="fale-conosco" style="width:70%; height:100%; float:right;" >

        

            
            <div class="contato" style="margin-top: 0px;height: 140%;">
                <hr />
                <div>
				<h4>Telefones</h4>
                    <span class="separator"></span>
                    <p>telefone1</p>
					<p>telefone2</p>
					<p>telefone3</p>
					
                    <h4>Fale Conosco</h4>
                    <span class="separator"></span>
                    <form action="<?php echo GLOBAL_PATH; ?>_assets/ajax/contato.php" id="formContato" >
                        <input type="text" data-validate name="nome"  data placeholder="Name" value = "<?php echo $nome ?>">
                        <input type="text" data-validate name="email" placeholder="E-mail" value = "<?php echo $email ?>"> 
                        <textarea name="mensagem" id="" placeholder="Message"></textarea>
                        <input type="submit" value="ENVIAR">
                    </form>
                </div>
                
            </div>
            
        
        
    </body>
</html>

</head>
<body>
</body>

</div>