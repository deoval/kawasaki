	
        <hr /> 

        <p class="header">
            Cadastro de clientes
        </p>

        <h2>
            PREENCHA OS CAMPOS ABAIXO PARA SE CADASTRAR
        </h2>
    <form action="<?php echo GLOBAL_PATH; ?>controller.php" name="fCadastro" id="fCadastro" method="post">
        <table class="content" style="width: 600px;position: relative;margin: 30px auto;">
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[nome]" id="nome" placeholder="Nome"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[email]" id="email" placeholder="E-mail"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[cpf]" id="cpf" data-mask="cpf" placeholder="Cpf"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[cnpj]" id="cnpj" data-mask="cnpj" placeholder="Cnpj"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[empresa]" id="empresa" data-mask="empresa" placeholder="Empresa"/>
                </td>
            </tr>			
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[telefone]" id="telefone" data-mask="telefone" placeholder="Telefone"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="password" name="cliente[senha]" id="senha" placeholder="Senha"/>
                </td>
            </tr>			
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[endereco]" id="endereco" placeholder="Endereco"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[numero]" id="numero" placeholder="Numero"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[complemento]" id="complemento" placeholder="Complemento"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="cliente[bairro]" id="bairro" placeholder="Bairro"/>
                </td>
            </tr>
			<tr>
                <td colspan="2">
                    <input type="text" name="cliente[cep]" id="cep" placeholder="Cep"/>
                </td>
            </tr>			
			<tr>
                <td colspan="2">
                    <input type="text" name="cliente[cidade]" id="cidade" placeholder="Cidade"/>
                </td>
            </tr>
			<tr>
                <td colspan="2" style="    font-size: 20px;color: #222;text-align: left;margin: 20px 0;">
                    <input type="checkbox" name="cliente[termos]" id="termos" value="1" /> Aceite os termos
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="cmd" id="comd" value="salvarCliente"/>
                    <input type="submit" name="btnSalvar" id="btnSalvar" value="Salvar"/>
                </td>
            </tr>
        </table>
    </form>
