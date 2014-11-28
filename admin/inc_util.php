<iframe name="actionFrame" id="actionFrame" src="about:blank" style="position: absolute;display:none; background-color: #fff; height:200px; margin-left: 5%; width:90%; top: 0px; position: fixed; z-index: 50000;"></iframe>

<!-- Modal Confirm para excluir itens -->
<div class="modal fade" id="modal-trash" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Deseja realmente excluir?</h4>
            </div>
            <div class="modal-footer" style='border-top: none;'>
                <button type="button" class="btn btn-flat default btn-modal-deletar"> Sim </button>
                <button type="button" class="btn btn-flat success" data-dismiss="modal"> Não </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php if ($_SESSION[_EMPRESA_]["SYS"]["id_usuario_perfil"] == 1) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).keyup(function(e) {
                //alert(e.which);
                if (e.which == 40)
                    $('#actionFrame').css("display", "block");
                else if (e.which == 38)
                    $('#actionFrame').css("display", "none");
            });
        });
    </script>
    <?php
}
?>
