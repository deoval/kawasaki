// JavaScript Document
var Motoboy = {
    'lista': function(page) {

        var dataMotoboy = $('#filtroMotoboy').serialize();
        dataMotoboy += '&cmd=listar';

        if (!isNaN(page) && page > 0)
            dataMotoboy += '&page=' + page;

        $.ajax({
            url: "../motoboy/controller.php",
            type: "POST",
            data: dataMotoboy,
            dataType: "json",
            success: function(data) {
                console.log(data);

                $ini = (data.pages == null) ? 1 : ((data.page - 1) * (data.pageRows) + 1);
                $lim = (data.pages == null) ? data.records : ((data.page * data.pageRows) > (data.page * data.rows.length)) ? data.records : data.page * data.rows.length;
                // console.log($ini + '-' + $lim);
                $('.pagCont').text($ini + ' a ' + $lim + ' de ' + data.records + ' itens');

                var tableHtml = '';
                if (parseInt(data.records) > 0) {
                    for (var indexTr = 0; indexTr < data.rows.length; indexTr++) {
                        var firstClass = indexTr == 0 ? 'first' : '';
                        tableHtml += '<tr class = "' + firstClass + '" data-id="' + data.rows[indexTr].id + '">';
                        for (var indexTd = 0; indexTd < data.rows[indexTr].cell.length; indexTd++) {
                            tableHtml += '<td>' + data.rows[indexTr].cell[indexTd] + '</td>';
                        }
                        tableHtml += '<td class="align-right">';
                        tableHtml += '<a class="btn btn-info" href="../motoboy/form.php?ID=' + data.rows[indexTr].id + '"><i class="icon-pencil"></i></a>';
                        tableHtml += '<a class="btn btn-danger btn-deletar" data-toggle="modal" href="#modal-trash"><i class="icon-trash" onClick="Motoboy.modaldeletarattr(' + data.rows[indexTr].id + ')"></i></a>';
                        tableHtml += '</td>';

                        tableHtml += '</tr>';
                    }
                }

                $('#grid-motoboy > tbody').html(tableHtml);

                var pagesHtml = '';
                if ($('#pagination-motoboy').length) {
                    if (data.pages != null) {

                        if (data.page > 1) {
                            pagesHtml += '<li><a href="javascript:;;" onClick="Motoboy.lista(' + (data.page - 1) + ')">&#8249;</a></li>';
                        } else {
                            pagesHtml += '<li><a href="javascript:;;" class="desabled">&#8249;</a></li>';
                        }

                        for (var indexPage = 0; indexPage < data.pages.length; indexPage++) {
                            var selectedClass = data.pages[indexPage].selected ? 'active' : '';
                            pagesHtml += '<li class="' + selectedClass + '"><a href="javascript:;;" onClick="Motoboy.lista(' + data.pages[indexPage].page + ');">' + data.pages[indexPage].page + '</a></li>';
                        }

                        if (data.totalPages > data.page) {
                            pagesHtml += '<li><a href="javascript:;;" onClick="Motoboy.lista(' + (data.page + 1) + ')">&#8250;</a></li>';
                        } else {
                            pagesHtml += '<li><a href="javascript:;;" class="desabled">&#8250;</a></li>';
                        }
                    }

                }
                $('#pagination-motoboy').html(pagesHtml);

            },
            error: function() {
            }
        });
    },
    'closeForm': function(id) {
        Common.closeFrame();
        document.location.href = '../motoboy/main.php';
    },
    'loadForm': function() {
        $('#fMotoboy #nome').focus();
        MASK('#fMotoboy');
    },
    'multiDeleta': function() {
        var total = 0;
        var finished = 0;

        total = $('.deletar:checked').length;
        if (total == 0) {
            alert('Nenhum registro selecionado!');
            return false;
        }

        if (confirm('Tem certeza que deseja excluir os registros selecionadas?\nEsta operação é irreversível!'))
        {

            $('.deletar:checked').each(function() {
                $.get('controller.php', {
                    CMD: 'multi-excluir',
                    id: $(this).val()
                }, function(retorno) {
                    finished++;

                    if (retorno != "") {
                        alert(retorno);
                        finished = 0;
                        Motoboy.lista();
                        return false;
                    }

                    if (finished == total) {
                        finished = 0;
                        Motoboy.lista();
                        alert('Registros removidos com sucesso!');
                    }
                });
            });
        }
    },
    'modaldeletarattr': function(id) {
        $('#modaldeletar').attr('onClick', 'Motoboy.deleta('+ id +')');
		
    },
    'deleta': function(id) {
			var dataMotoboy = 'cmd=excluir&id='+ id;
            $.ajax({
            url: "../motoboy/controller.php",
            type: "POST",
            data: dataMotoboy,
            dataType: "json",
            success: function(data) {
                window.location.reload();
			},
            error: function() {
            }
        });
		
    },
    'valida': function(form)
    {
        if ($('#nome', '#' + form).val() == "")
        {
            alert('Você precisa preencher o campo nome! ');
            $('#nome', '#' + form).focus();
            return false;
        }

        //lib.js
        if (!validaEmail($('#email', '#' + form).val()))
        {
            $('#email', '#' + form).focus();
            return false;
        }

        if ($('#senha', '#' + form).val() == "" && ($('#id_motoboy', '#' + form).val() == "" || $('#id_motoboy', '#' + form).val() == 0))
        {
            alert('Você precisa preencher o campo senha! ');
            $('#senha', '#' + form).focus();
            return false;
        }

        if ($('#senha', '#' + form).val() != "" && $('#senha', '#' + form).val().length < 4)
        {
            alert('O campo senha deve ter pelo menos 4 caracteres! ');
            $('#senha', '#' + form).focus();
            return false;
        }

        if ($('#senha', '#' + form).val() != "" && $('#senha', '#' + form).val() != $('#repetirSenha', '#' + form).val())
        {
            alert('As senham não conferem! ');
            $('#senha', '#' + form).focus();
            return false;
        }
    }
}