// JavaScript Document
var Categoria = {
    'lista': function(page) {

        var dataCategoria = $('#filtroCategoria').serialize();
        dataCategoria += '&cmd=listar';

        if (!isNaN(page) && page > 0)
            dataCategoria += '&page=' + page;

        $.ajax({
            url: "../categoria/controller.php",
            type: "POST",
            data: dataCategoria,
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
                        tableHtml += '<a class="btn btn-info" href="../categoria/form.php?ID=' + data.rows[indexTr].id + '"><i class="icon-pencil"></i></a>';
                        tableHtml += '<a class="btn btn-danger btn-deletar" data-toggle="modal" href="#modal-trash" onClick="Categoria.modaldeletarattr(' + data.rows[indexTr].id + ')"><i class="icon-trash"></i></a>';
                        tableHtml += '</td>';

                        tableHtml += '</tr>';
                    }
                }

                $('#grid-categoria > tbody').html(tableHtml);

                var pagesHtml = '';
                if ($('#pagination-categoria').length) {
                    if (data.pages != null) {

                        if (data.page > 1) {
                            pagesHtml += '<li><a href="javascript:;;" onClick="Categoria.lista(' + (data.page - 1) + ')">&#8249;</a></li>';
                        } else {
                            pagesHtml += '<li><a href="javascript:;;" class="desabled">&#8249;</a></li>';
                        }

                        for (var indexPage = 0; indexPage < data.pages.length; indexPage++) {
                            var selectedClass = data.pages[indexPage].selected ? 'active' : '';
                            pagesHtml += '<li class="' + selectedClass + '"><a href="javascript:;;" onClick="Categoria.lista(' + data.pages[indexPage].page + ');">' + data.pages[indexPage].page + '</a></li>';
                        }

                        if (data.totalPages > data.page) {
                            pagesHtml += '<li><a href="javascript:;;" onClick="Categoria.lista(' + (data.page + 1) + ')">&#8250;</a></li>';
                        } else {
                            pagesHtml += '<li><a href="javascript:;;" class="desabled">&#8250;</a></li>';
                        }
                    }

                }
                $('#pagination-categoria').html(pagesHtml);

            },
            error: function() {
            }
        });
    },
    'closeForm': function(id) {
        Common.closeFrame();
        document.location.href = '../categoria/main.php';
    },
    'loadForm': function() {
        $('#fCategoria #nome').focus();
        MASK('#fCategoria');
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
                        Categoria.lista();
                        return false;
                    }

                    if (finished == total) {
                        finished = 0;
                        Categoria.lista();
                        alert('Registros removidos com sucesso!');
                    }
                });
            });
        }
    },
    'modaldeletarattr': function(id) {
        $('#modaldeletar').attr('onClick', 'Categoria.deleta('+ id +')');
		
    },
    'deleta': function(id) {
			var dataCategoria = 'cmd=excluir&id='+ id;
            $.ajax({
            url: "../categoria/controller.php",
            type: "POST",
            data: dataCategoria,
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
            alert('Você precisa preencher o campo item! ');
            $('#nome', '#' + form).focus();
            return false;
        }
    }
}