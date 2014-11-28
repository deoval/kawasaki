<?php
include_once('./site/inc/header.php');
?>
<form action="<?php echo GLOBAL_PATH; ?>controller.php" name="fLogin" id="fLogin" method="post">
    <table class="content">
        <tr>
            <td colspan="2">
                <input type="text" name="user" id="user" placeholder="Usuário"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="password" name="senha" id="senha" placeholder="Senha"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="cmd" id="comd" value="login"/>
                <input type="submit" name="btnLogin" id="btnLogin" value="Entrar"/>
            </td>
        </tr>
        <tr>
            <td width="50%" align="center">
                <a href="<?php echo GLOBAL_PATH; ?>cad-cliente">Cadastro Cliente</a>
            </td>
            <td width="50%" align="center">
                <a href="<?php echo GLOBAL_PATH; ?>cad-motoboy">Cadastro Motoboy</a>
            </td>
        </tr>
    </table>
</form>
<?php
include_once('./site/inc/footer.php');