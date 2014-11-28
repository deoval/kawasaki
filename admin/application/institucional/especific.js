// JavaScript Document
var Institucional = {
    'lista': function(page) {

        var dataInstitucional = $('#filtroInstitucional').serialize();
        dataInstitucional += '&cmd=listar';

        if (!isNaN(page) && page > 0)
            dataInstitucional += '&page=' + page;

        $.ajax({
            url: "../institucional/controller.php",
            type: "POST",
            data: dataInstitucional,
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
                        tableHtml += '<a class="btn btn-info" href="../institucional/form.php?ID=' + data.rows[indexTr].id + '"><i class="icon-pencil"></i></a>';
                        tableHtml += '<a class="btn btn-danger btn-deletar" data-toggle="modal" href="#modal-trash"><i class="icon-trash"></i></a>';
                        tableHtml += '</td>';

                        tableHtml += '</tr>';
                    }
                }

                $('#grid-institucional > tbody').html(tableHtml);

                var pagesHtml = '';
                if ($('#pagination-institucional').length) {
                    if (data.pages != null) {

                        if (data.page > 1) {
                            pagesHtml += '<li><a href="javascript:;;" onClick="Institucional.lista(' + (data.page - 1) + ')">&#8249;</a></li>';
                        } else {
                            pagesHtml += '<li><a href="javascript:;;" class="desabled">&#8249;</a></li>';
                        }

                        for (var indexPage = 0; indexPage < data.pages.length; indexPage++) {
                            var selectedClass = data.pages[indexPage].selected ? 'active' : '';
                            pagesHtml += '<li class="' + selectedClass + '"><a href="javascript:;;" onClick="Institucional.lista(' + data.pages[indexPage].page + ');">' + data.pages[indexPage].page + '</a></li>';
                        }

                        if (data.totalPages > data.page) {
                            pagesHtml += '<li><a href="javascript:;;" onClick="Institucional.lista(' + (data.page + 1) + ')">&#8250;</a></li>';
                        } else {
                            pagesHtml += '<li><a href="javascript:;;" class="desabled">&#8250;</a></li>';
                        }
                    }

                }
                $('#pagination-institucional').html(pagesHtml);

            },
            error: function() {
            }
        });
    },
    'closeForm': function(id) {
        Common.closeFrame();
        document.location.href = '../institucional/main.php';
    },
    'loadForm': function() {
        $('#fInstitucional #titulo').focus();
        MASK('#fInstitucional');
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
                        Institucional.lista();
                        return false;
                    }

                    if (finished == total) {
                        finished = 0;
                        Institucional.lista();
                        alert('Registros removidos com sucesso!');
                    }
                });
            });
        }
    },
    'deleta': function(id) {
        $('#actionFrame').attr('src', '../institucional/controller.php?cmd=excluir&id=' + id);
    },
    'valida': function(form)
    {
        if ($('#titulo', '#' + form).val() == "")
        {
            alert('Você precisa preencher o campo titulo! ');
            $('#titulo', '#' + form).focus();
            return false;
        }
    }
}