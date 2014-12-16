<div class="subnavbar">

  <div class="subnavbar-inner">
  
    <div class="container">
      
      <a href="javascript:;" class="subnav-toggle" data-toggle="collapse" data-target=".subnav-collapse">
          <span class="sr-only">Toggle navigation</span>
          <i class="icon-reorder"></i>
          
        </a>

      <div class="collapse subnav-collapse">
        <ul class="mainnav">
        <?php
        $arrayMenu = array(
            array('idMenu' => 1, 'link' => "../dashboard/main.php", 'title' => "Dashboard", 'icon' => "icon-home"),
            array('idMenu' => 4, 'link' => "javascript:;;", 'title' => "Textos", 'icon' => "icon-quote-right"),
            array('idMenu' => 7, 'link' => "../cliente/main.php", 'title' => "Clientes", 'icon' => "icon-group"),
            array('idMenu' => 9, 'link' => "../motoboy/main.php", 'title' => "Moto boy", 'icon' => "icon-bicycle"),
            array('idMenu' => 10, 'link' => "javascript:;;", 'title' => "Atendimento", 'icon' => "icon-comment"),
            array('idMenu' => 6, 'link' => "javascript;;", 'title' => "Solicitacao", 'icon' => "icon-inbox"),	
			//array('idMenu' => 2, 'link' => "../config/main.php", 'title' => "Configurações", 'icon' => "icon-cog"),
			array('idMenu' => 2, 'link' => "javascript:;;", 'title' => "Configurações", 'icon' => "icon-cog"),
        );

        $arraySubmenu = array(
            10 => array(
                array('link' => "../contato/main.php", 'title' => "Contato"),
                array('link' => "../telefone/main.php", 'title' => "Telefones"),
            ),
			2 => array(
                array('link' => "../config/main.php", 'title' => "Globais"),
                array('link' => "../categoria/main.php", 'title' => "Categorias"),
            ),
            6 => array(
                array('link' => "../solicitacao/alocar.php", 'title' => "Alocar Motoboy"),
                array('link' => "../solicitacao/finalizar.php", 'title' => "Finalizar Solicitação"),
                array('link' => "../solicitacao/relatorioCliente.php", 'title' => "Relatório - Cliente"),
                array('link' => "../solicitacao/relatorioMotoboy.php", 'title' => "Relatório - Motoboy"),				
            ),
        );

        $db = new DB();
        $db->setFrom("institucional");
        $db->setOrder("titulo ASC");
        $db->Query($db->Select());

        while ($item = $db->FetchArray()) {
            $arraySubmenu[4][] = array('link' => "../institucional/form.php?ID=" . $item['id_institucional'], 'title' => $item['titulo']);
        }


        foreach ($arrayMenu as $valor) {
            $html = $classLi = $attrLink = "";
            
            if (array_key_exists($valor['idMenu'], $arraySubmenu) && count($arraySubmenu[$valor['idMenu']]) > 0) {
                $classLi .= "dropdown";
                $html = '<b class="caret"></b>';
                $attrLink = 'class="dropdown-toggle" data-toggle="dropdown"';
            }
            
            if ($menu == $valor['idMenu'])
                $classLi .= ' active';
            
            echo"
                    <li class='$classLi'>
                        <a href='" . $valor['link'] . "' $attrLink>
                            <i class='" . $valor['icon'] . "'></i>
                            <span>" . $valor['title'] . "</span>
                            $html
                        </a>
                ";
            if (array_key_exists($valor['idMenu'], $arraySubmenu) && count($arraySubmenu[$valor['idMenu']]) > 0) {
                echo"<ul class='dropdown-menu'>";
                foreach ($arraySubmenu[$valor['idMenu']] as $submenu) {
                    echo"<li><a href='" . $submenu['link'] . "'>" . $submenu['title'] . "</a></li>";
                }
                echo"</ul>";
            }
            echo"</li>";
        }
        ?>
        
        </ul>
      </div> <!-- /.subnav-collapse -->

    </div> <!-- /container -->
  
  </div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->