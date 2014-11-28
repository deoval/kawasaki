$(function() {

    jQuery.support.placeholder = false;
    test = document.createElement('input');
    if ('placeholder' in test)
        jQuery.support.placeholder = true;

    if (!$.support.placeholder) {
        $('.field').find('label').show();
    }

    $('#fLogin').submit(function(e) {
        e.preventDefault();
        logar();
    });

});

function logar() {
    if ($('#usuario', '#fLogin').val() == "")
    {
        alert('Você precisa preencher o campo usuário! ');
        $('#usuario', '#fLogin').focus();
        return false;
    }

    if ($('#senha', '#fLogin').val() == "")
    {
        alert('Você precisa preencher o campo senha! ');
        $('#senha', '#fLogin').focus();
        return false;
    }

    $.ajax({
        url: "ajax_login.php",
        type: "POST",
        data: $('#fLogin').serialize(),
        dataType: "json",
        success: function(data) {
            console.log(data);
            if (data.error == 1) {
                alert(data.message);
            } else
            if (data.fabrica == 1) {
                document.location.href = 'application/pedido/main.php';
            } else {
                document.location.href = 'application/dashboard/main.php';
            }
        }
    });
}