<?php 
    include_once('inc/header.php');
	
	$objconfig = new Config();
	$destinatario = $objconfig->_lista(array(  item =>  "item = 'destinatario_contato_home'"),"","")[0]['value'];
 ?>
        <main id="home">

            <div class="bannerHome">
                <img src="<?php echo GLOBAL_PATH; ?>_assets/img/bannerhome.jpg" alt="">
            </div>

            <div class="clear"></div>
            <section class="conteudo wrapper">

                <hr /> 

                <p class="header">
                    Confira nossos principais serviços.
                </p>

                <h2>
                    A MANEIRA MAIS RÁPIDA E ECONÔMICA DE FAZER SUAS ENTREGAS E RETIRADAS.
                </h2>

                <article class="noticias" style="background:url(<?php echo GLOBAL_PATH; ?>_assets/img/noticiaHome.jpg) no-repeat center top">
                    <div class="inner">
                        <h3>Serviços de Emergência</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio assumenda ratione tempora, necessitatibus minus itaque magnam ut quis maiores. Laudantium enim eos ad dolore fugit itaque recusandae, quia doloribus placeat!
                        </p>
                        <a href="javascript:void(0);">SAIBA MAIS</a>
                    </div>
                </article>

                <ul class="bxslider">
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider1.jpg" /></li>
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider2.jpg" /></li>
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider3.jpg" /></li>
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider4.jpg" /></li>
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider1.jpg" /></li>
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider2.jpg" /></li>
                  <li><img src="<?php echo GLOBAL_PATH; ?>_assets/img/slider3.jpg" /></li>
                </ul>

            <div class="clear"></div>
            <div class="contato">
                <hr />
                <div>
                    <h4>CHAT ONLINE</h4>
                    <span class="separator"></span>
                    <p>
                        Fale conosco através de nosso chat
                    </p>
                    <h4>ENTRE EM CONTATO</h4>
                    <span class="separator"></span>
                    <form action="<?php echo GLOBAL_PATH; ?>_assets/ajax/contato.php" id="formContato" >
						<input type="hidden" name="destinatario" id="destinatario" value = "<?php echo $destinatario ?>"/>
                        <input type="text" data-validate name="nome"  data placeholder="Name">
                        <input type="text" data-validate name="email" placeholder="E-mail"> 
                        <textarea name="mensagem" id="" placeholder="Message"></textarea>
                        <input type="submit" value="ENVIAR">
                    </form>
                </div>
                <div>
                    <h4>LOCALIDADE</h4>
                    <span class="separator"></span>
                    <p>Alameda Pamaris, 254</p>
                    <p>São Paulo, SP</p>
                    <br />
                    <p>Seg - Qui 11h - 23h</p>
                    <p>Sex - Dom 11h - 24h</p>
                    <br />
                    <h4>SIGA-NOS</h4>
                    <span class="separator"></span>
                    <img src="<?php echo GLOBAL_PATH; ?>_assets/img/redesociais.jpg" alt="">
                </div>
                <div class="mapa">
                    <div id="map-canvas"></div>
                </div>
            </div>
            </section>
        </main>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script>
             var map;
             function initialize() {
                var featureOpts = [
                   {
                     "stylers": [
                       { "saturation": -100 },
                       { "lightness": 18 },
                       { "gamma": 1.66 }
                     ]
                   }
                 ];

               pos = new google.maps.LatLng(-23.551788, -46.635125);
               var mapOptions = {
                 zoom: 15,
                 center: pos,
                 styles: featureOpts
               };
               map = new google.maps.Map(document.getElementById('map-canvas'),
                   mapOptions);

              marker = new google.maps.Marker({
                 position: pos,
                 map: map
              });
              map.setCenter(pos);

             }

             google.maps.event.addDomListener(window, 'load', initialize);
        </script>  
        <script src="<?php echo GLOBAL_PATH; ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo GLOBAL_PATH; ?>bower_components/foundation/js/foundation.min.js"></script>
        <script src="<?php echo GLOBAL_PATH; ?>_assets/js/plugins.js"></script>
        <script src="<?php echo GLOBAL_PATH; ?>_assets/js/main.js"></script>
    </body>
</html>

</head>
<body>
</body>