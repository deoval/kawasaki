<?php
include_once('./site/inc/header.php');
?>
<main id="cad-motoboy">

    <div class="bannerHome">
        <img src="<?php echo GLOBAL_PATH; ?>_assets/img/bannerhome.jpg" alt="">
    </div>

    <div class="clear"></div>
    <section class="conteudo wrapper">
        <hr /> 

        <p class="header">
            Cadastro de Motoboys
        </p>

        <h2>
            PREENCHA OS CAMPOS ABAIXO PARA SE CADASTRAR
        </h2>
    <form action="<?php echo GLOBAL_PATH; ?>controller.php" name="fMotoboy" id="fMotoboy" method="post" enctype="multipart/form-data">
        <table class="content" style="width: 600px;position: relative;margin: 30px auto;">
            <tr>            
                <td colspan="2">             
                    <input type="text" name="motoboy[nome]" placeholder="Nome:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[email]" placeholder="E-mail:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">             
                    <input type="text" name="motoboy[data_nascimento]" data-mask="data" placeholder="Data Nascimento:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">             
                    <input type="text" name="motoboy[telefone]" data-mask="telefone" placeholder="Telefone:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[celular]" data-mask="telefone" placeholder="Celular:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[placa]" data-mask="placa" placeholder="Placa"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[cep]" data-mask="cep" placeholder="CEP:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[endereco]" placeholder="Endereço:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[numero]" data-mask="numero" placeholder="Número:"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">              
                    <input type="text" name="motoboy[complemento]" placeholder="Complemento:"/>
                </td>
            </tr>
            <tr>            
                <td colspan="2">              
                    <input type="text" name="motoboy[bairro]" placeholder="Bairro"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">    
                    <input type="text" name="motoboy[cpf]" data-mask="cpf" placeholder="CPF:"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">            
                    <input type="text" name="motoboy[rg]" data-mask="rg" placeholder="RG:"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">             
                    <input type="text" name="motoboy[condumoto]" data-mask="condumoto" placeholder="Condumoto:"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">             
                    <input type="text" name="motoboy[licenca]" data-mask="licenca" placeholder="Licença"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">              
                    <input type="password" name="motoboy[senha]" placeholder="Senha"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2">   
					Foto:
                    <input type="file" name="foto" placeholder="Foto:"/>
                </td>
            </tr>
            <tr>           
                <td colspan="2" >
					Cópia da CNH:
                    <input type="file" name="cnh" placeholder="Copia da CNH:"/>
                </td>
            </tr>
            <tr>
                <td colspan="2"  style="    font-size: 20px;color: #222;text-align: left;margin: 20px 0;">
                    <input type="checkbox" name="motoboy[termos]" id="termos" value="1" /> Aceite os termos
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="cmd" id="comd" value="salvarMotoboy"/>
                    <input type="submit" name="btnSalvar" id="btnSalvar" value="Salvar"/>
                </td>
            </tr>
        </table>
     </form>
    <section>
</main>

<?php
include_once('./site/inc/footer.php');
?>
