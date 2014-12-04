window.PRO = {};

PRO.geral = function() {
};

PRO.home = {
    init: function() {
        this.main();
        this.mask();
    },
    mask:function(){
      function mascara(form) {

          $(form + ' input[data-mask=telefone]').each(function() {

              $(this).mask("(99) 9999-9999?9");

          });

          $(form + ' input[data-mask=cep]').each(function() {

              $(this).mask("99999-999");

          });

          $(form + ' input[data-mask=porcentagem]').each(function() {

              $(this).mask("99.9");

          });

          $(form + ' input[data-mask=cpf]').each(function() {

              $(this).mask("999.999.999-99");

          });

          $(form + ' input[data-mask=rg]').each(function() {

              $(this).mask("99.999.999-9");

          });

          $(form + ' input[data-mask=conduPRO]').each(function() {

              $(this).mask("999.999-99");

          });

          $(form + ' input[data-mask=licenca]').each(function() {

              $(this).mask("999.999-99");

          });

          $(form + ' input[data-mask=cnpj]').each(function() {

              $(this).mask("99.999.999/9999-99");

          });

          $(form + ' input[data-mask=data]').each(function() {

              $(this).mask("99/99/9999");

          });

          $(form + ' input[data-mask=datahora]').each(function() {

              $(this).mask("99/99/9999 99:99:99");

          });

          $(form + ' input[data-mask=ano]').each(function() {

              $(this).mask("9999");

          });

          $(form + ' input[data-mask=mes]').each(function() {

              $(this).mask("99");

          });

          $(form + ' input[data-mask=placa]').each(function() {

              $(this).mask("aaa-9999");

          });

          $(form + ' input[data-mask=moeda]').each(function() {

              $(this).keyup(function(event) {

                  formataMoeda(this, event);

              });

              $(this).keydown(function(event) {

                  formataMoeda(this, event);

              });

          });

          $(form + ' input[data-mask=dia_mes]').each(function() {

              $(this).mask("99/99");

          });

          $(form + ' input[data-mask=ano_sem]').each(function() {

              $(this).mask("9999/99");

          });

          $(form + ' input[data-mask=time]').each(function() {

              $(this).mask("99:99:99");

          });

          $(form + ' input[data-mask=hora_minuto]').each(function() {

              $(this).mask("99:99");

          });

          $(form + ' input[data-mask=numero]').each(function() {

              $(this).keyup(function(event) {

                  if (((event.keyCode < 96) || (event.keyCode > 105)) && ((event.keyCode < 48) || (event.keyCode > 57))) {
                      $(this).val($(this).val().replace(String.fromCharCode(event.keyCode).toLowerCase(), ""));
                  }

              });

              $(this).keydown(function(event) {

                  if (((event.keyCode < 96) || (event.keyCode > 105)) && ((event.keyCode < 48) || (event.keyCode > 57))) {
                      $(this).val($(this).val().replace(String.fromCharCode(event.keyCode).toLowerCase(), ""));
                  }

              });

          });
      }
      function ucfirst(string)
      {
          return string.charAt(0).toUpperCase() + string.slice(1);
      }

      //verifica se é numero
      function verificaNumero(obj)
      {
          //verifica se não é numero
          if (isNaN(obj.value))
          {
              alert('Você deve digitar um número!');
              obj.value = "";
          }
      }
      function formataMoeda(campo, evt) {

          //para evitar caracteres alfas.
          if (((evt.keyCode < 96) || (evt.keyCode > 105)) && ((evt.keyCode < 48) || (evt.keyCode > 57))) {
              campo.value = campo.value.replace(String.fromCharCode(evt.keyCode).toLowerCase(), "");
          }
          str = campo.value;

          while (str.search(",") != - 1)
              str = str.replace(",", "");

          var i = 0;

          while (i < str.length) {
              if (str.substr(i, 1) == ".")
                  str = str.replace(".", "");
              i++;
          }

          part1 = str.substr(0, str.length - 2);
          while (part1.search(" ") != - 1)
              part1 = part1.replace(" ", "");

          part2 = str.substr(str.length - 2, 2);
          res = "";
          i = part1.length;
          sob = i % 3;
          if ((sob != 0) && (i > 2))
              res = part1.substr(0, sob) + ".";
          else
              res = part1.substr(0, sob);
          j = 1;
          part1 = part1.substr(sob);
          i = 0;
          while (i < part1.length) {
              if (j == 3) {
                  if (i + 1 == part1.length)
                      res = res + part1.substr(i - 2, 3);
                  else
                      res = res + part1.substr(i - 2, 3) + ".";
              }
              i++;
              j = j < 3 ? j + 1 : 1;
          }
          campo.value = res + "," + part2;

          if (campo.value == ',')
              campo.value = '';

      }

      function validaEmail(email)
      {
          if (email == "")
          {
              alert('Você precisa digitar um endereço de e-mail! ');
              return false;
          }

          if (email.search(/^\w+((-\w+)|(\.\w+))*\@\w+((\.|-)\w+)*\.\w+$/) == -1)
          {
              alert('Você precisa digitar um endereço de e-mail valido! ');
              return false;
          }

          return true;
      }
      function validaCNPJ(cnpj) {

          cnpj = cnpj.replace(/[^\d]+/g, '');

          if (cnpj == '')
              return false;

          if (cnpj.length != 14)
              return false;

          // Elimina CNPJs invalidos conhecidos
          if (cnpj == "00000000000000" ||
                  cnpj == "11111111111111" ||
                  cnpj == "22222222222222" ||
                  cnpj == "33333333333333" ||
                  cnpj == "44444444444444" ||
                  cnpj == "55555555555555" ||
                  cnpj == "66666666666666" ||
                  cnpj == "77777777777777" ||
                  cnpj == "88888888888888" ||
                  cnpj == "99999999999999")
              return false;

          // Valida DVs
          tamanho = cnpj.length - 2
          numeros = cnpj.substring(0, tamanho);
          digitos = cnpj.substring(tamanho);
          soma = 0;
          pos = tamanho - 7;
          for (i = tamanho; i >= 1; i--) {
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2)
                  pos = 9;
          }
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(o))
              return false;

          tamanho = tamanho + 1;
          numeros = cnpj.substring(0, tamanho);
          soma = 0;
          pos = tamanho - 7;
          for (i = tamanho; i >= 1; i--) {
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2)
                  pos = 9;
          }
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(1))
              return false;

          return true;

      }
      function validaCPF(cpf) {

          cpf = cpf.replace(/[^\d]+/g, '');

          if (cpf == '')
              return false;

          // Elimina CPFs invalidos conhecidos
          if (cpf.length != 11 ||
                  cpf == "00000000000" ||
                  cpf == "11111111111" ||
                  cpf == "22222222222" ||
                  cpf == "33333333333" ||
                  cpf == "44444444444" ||
                  cpf == "55555555555" ||
                  cpf == "66666666666" ||
                  cpf == "77777777777" ||
                  cpf == "88888888888" ||
                  cpf == "99999999999")
              return false;

          // Valida 1o digito
          add = 0;
          for (i = 0; i < 9; i ++)
              add += parseInt(cpf.charAt(i)) * (10 - i);
          rev = 11 - (add % 11);
          if (rev == 10 || rev == 11)
              rev = 0;
          if (rev != parseInt(cpf.charAt(9)))
              return false;

          // Valida 2o digito
          add = 0;
          for (i = 0; i < 10; i ++)
              add += parseInt(cpf.charAt(i)) * (11 - i);
          rev = 11 - (add % 11);
          if (rev == 10 || rev == 11)
              rev = 0;
          if (rev != parseInt(cpf.charAt(10)))
              return false;

          return true;

      }
      mascara('#fBusca');
      if($('#fCadastro').length)
        mascara('#fCadastro');
    },
    main: function() {

      $('.bxslider').bxSlider({
        pager: false,
        controls: true,
        minSlides: 4,
        maxSlides: 4,
        slideWidth: 240,
        slideMargin: 20
      });
           
        $('#formContato').on('submit', function () {

          $this = $(this);

          $this.find('[data-validate]').each(function(){
            if($(this).val() == ''){
              $(this).addClass('erro');
              if($('label[for="'+$(this).attr('id')+'"]').length)
                $('label[for="'+$(this).attr('id')+'"]').addClass('erro');
            } else {
              $(this).removeClass('erro');
              if($('label[for="'+$(this).attr('id')+'"]').length)
                $('label[for="'+$(this).attr('id')+'"]').removeClass('erro');
            }
          });

          var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if(!re.test($('input[placeholder="E-mail"]').val())){
            $('input[placeholder="E-mail"]').addClass('erro');
          } else {
            $('input[placeholder="E-mail"]').removeClass('erro');
          }


          if(!$(this).find('.erro').length){
            $.ajax({ 
              url: './_assets/ajax/contato.php',
              type: 'post',
              data: $(this).serialize(),
              success: function (data) {
                if(data == 'sucesso'){
                  alert('Mensagem enviada com sucesso!');
                  location.reload();
                }
              }
            });
          }
          return false;
        });
       if ($('input[data-mask=cep]').length) {
           $('input[data-mask=cep]').on('keyup', function() {
               var $this = $(this),
                       content = $this.val().replace('-', '').replace('_',''),
                       tipo = $this.attr('data-tipo');

               if (content.length == 8) {
                   $.ajax({
                       url: 'http://cep.correiocontrol.com.br/'+content+'.json',
                       type: 'get',
                       dataType: 'json',
                       success: function(data) {
                           console.log(data);
                           
                           $('input#'+tipo+'Endereco').val(data.logradouro);
                           $('input#'+tipo+'Bairro').val(data.bairro);
                           $('input#'+tipo+'Cidade').val(data.localidade);
                       }
                   });
               }

           });
       }
	   $('.slccateg').change(function(){
			
			$( ".slccateg option:selected" ).each(function() {
				
				var str= $( this ).val().split('|');
				var custoadicional = str[1];
				var valor = $('#spanprecoserv').text(); 
				$('#spancustoadicional').text(custoadicional);
				var valortotal = parseFloat(custoadicional) + parseFloat(valor);
				$('#spanvalortotal').text(valortotal);
				$('#solicitacao-valor').val(valortotal);
			});
					
		});
    }
};

//ON READY
(function($) {
    PRO.home.init();
    PRO.geral();
})(jQuery);


