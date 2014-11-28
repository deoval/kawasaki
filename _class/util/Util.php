<?php

/**
 * Classe com utilidados para o desenvolvimento
 *
 *
 * @author Roberto Carlos
 *
 */
class Util {

    /**
     * Envia a mensagem para o log e manda um email para os responsaveis
     *
     * @param string $msg Mensagem a ser enviada por email e para o log
     */
    public static function _logx($msg) {
        $ponteiro = fopen(LOCAL_PATH . "_assets/logx/logx.txt", "a+t");
        fwrite($ponteiro, "\r\n\r\n" . $msg);
        fclose($ponteiro);

        //'Cc: junior@n2it.com.br' . "\r\n".
        /*
          $to = "michaelluzpaulo@gmail.com";
          $subject = "Erro no site da Turismo de Presente";
          $headers = 'From: michaelluzpaulo@gmail.com' . "\r\n" .
          'Reply-To: michaelluzpaulo@gmail.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $msg, $headers); */
    }

    /**
     * Limpa completamente uma string retirando espaços e tags html/php
     *
     * @param string $string
     * @return string
     * LimpaStringCompleta
     */
    public static function LS($string) {
        $string = htmlentities($string, ENT_QUOTES);
        $string = get_magic_quotes_gpc() == true ? $string : addslashes($string);
        return $string;
    }

    /**
     * Verifica se uma string está vazia, retirando espaços
     *
     * @param string $string
     * @return boolean
     * 
     */
    public static function _isEmpty($string) {
        return (strlen(trim($string)) == 0) ? TRUE : FALSE;
    }

    /**
     * Exibe uma mensagem via javascript
     * e redireciona
     * @param string $texto
     * @param string $url
     */
    public static function _alertRedirect($texto, $url) {
        $texto = str_replace("'", "\'", str_replace(chr(10), '\n', str_replace(chr(13), '', $texto)));
        echo "<script type=\"text/javascript\">
                   alert('$texto');
                   document.location.replace('$url');
                 </script>";
    }

    /**
     * Exibe uma mensagem via javascript
     * Alert
     * @param string $texto
     */
    public static function _alert($texto) {
        $texto = str_replace("'", "\'", str_replace(chr(10), '\n', str_replace(chr(13), '', $texto)));
        echo "<script type=\"text/javascript\">
                   alert('$texto');
                 </script>";
    }

    /**
     * Exibe uma mensagem via javascript
     * e redireciona
     * @param string $url
     */
    public static function _redirect($url) {
        echo "<script type=\"text/javascript\">
                   document.location.replace('$url');
                 </script>";
    }

    /**
     * Fecha uma janela utilizando o javascrip window.close()
     *
     */
    public static function _winClose() {
        echo "<script type=\"text/javascript\">
                   window.close();
                  </script>";
    }

    /**
     * Imprime um script js
     *
     */
    public static function _jsCall($str) {
        echo "<script language=\"javascript\">";
        echo $str;
        echo "</script>";
    }

    /**
     * Mostra a estrutura do array
     *
     * @param array $value
     * @return /string/array
     */
    public static function _verArray($value) {
        return "<pre>" . var_dump($value) . "</pre>";
    }
    public static function array_chunk_vertical($data, $columns) {
        $n = count($data) ;
        $per_column = floor($n / $columns) ;
        $rest = $n % $columns ;

        // The map
        $per_columns = array( ) ;
        for ( $i = 0 ; $i < $columns ; $i++ ) {
            $per_columns[$i] = $per_column + ($i < $rest ? 1 : 0) ;
        }

        $tabular = array( ) ;
        foreach ( $per_columns as $rows ) {
            for ( $i = 0 ; $i < $rows ; $i++ ) {
                $tabular[$i][ ] = array_shift($data) ;
            }
        }

        return $tabular ;
    }
    public static function _upperCase($string) {

        $string = strtoupper($string);

        $string = str_replace("á", "Á", $string);
        $string = str_replace("é", "É", $string);
        $string = str_replace("í", "Í", $string);
        $string = str_replace("ó", "Ó", $string);
        $string = str_replace("ú", "Ú", $string);
        $string = str_replace("â", "Â", $string);
        $string = str_replace("ê", "Ê", $string);
        $string = str_replace("ô", "Ô", $string);
        $string = str_replace("Î", "I", $string);
        $string = str_replace("Û", "U", $string);
        $string = str_replace("ã", "Ã", $string);
        $string = str_replace("õ", "Õ", $string);
        $string = str_replace("ç", "Ç", $string);
        $string = str_replace("à", "A", $string);

        return $string;
    }

    public static function _lowerCase($string) {

        $string = strtolower($string);

        $string = str_replace("Á", "á", $string);
        $string = str_replace("É", "é", $string);
        $string = str_replace("Í", "í", $string);
        $string = str_replace("Ó", "ó", $string);
        $string = str_replace("Ú", "ú", $string);
        $string = str_replace("Â", "â", $string);
        $string = str_replace("Ê", "ê", $string);
        $string = str_replace("Ô", "ô", $string);
        $string = str_replace("Î", "î", $string);
        $string = str_replace("Ü", "ü", $string);
        $string = str_replace("Ã", "ã", $string);
        $string = str_replace("Õ", "õ", $string);
        $string = str_replace("Ç", "ç", $string);
        $string = str_replace("À", "à", $string);

        return $string;
    }

    /**
     * Converte um valor para o formato do banco
     * O parametro casas deve receber o nro de casas decimais retornadas por padrao
     *
     * @param string $string
     * @param int $casas
     * @return double
     */
    public static function _formataMoedaBanco($string, $casas = 2) {
        return str_replace(',', '.', str_replace('.', '', $string));
    }

    /**
     * Converte um valor do banco para um valor real
     * O parametro casas deve receber o nro de casas decimais retornadas por padrao
     *
     * @param double $float
     * @param int $casas
     * @return string
     */
    public static function _formataMoeda($float, $casas = 2) {
        return number_format($float, $casas, ',', '.');
    }

    /**
     * Adiciona zeros a esquerda
     *
     * @param int $maxCaracteres
     * @param string $string
     * @return string
     */
    public static function _adiconaZerosEsquerda($maxCaracteres, $string) {
        $auxStr = '';
        $tamanho = strlen($string);
        $auxCont = $maxCaracteres - $tamanho;
        if ($auxCont > 0) {
            for ($x = 1; $x <= $auxCont; $x++) {
                $auxStr.= '0';
            }
        }

        return $auxStr . $string;
    }

    /**
     * Gera uma senha aleatória simples
     * O parametro $caixa deve receber o tipo de caixa que sera mostrado
     * BAIXA - Retorna a senha em caixa baixa
     * ALTA - Retorna a senha em caixa ALTA
     * IGNORA - Retorna a senha sem mudança de caixa
     *
     * @param int $maxCaracteres
     * @param string $caixa
     * @return string
     */
    public static function _geraSenhaAleatoria($maxCaracteres, $caixa = 'IGNORA') {
        $lista = 'abcdefghijklmnopqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789';
        $max = strlen($lista) - 1;
        $senha = '';
        for ($x = 1; $x <= $maxCaracteres; $x++) {
            $senha.= $lista{mt_rand(0, $max)};
        }
        switch ($caixa) {
            case 'IGNORA': return $senha;
                break;
            case 'BAIXA': return strtolower($senha);
                break;
            case 'ALTA': return strtoupper($senha);
                break;
        }
    }

    /**
     * Monta a variável $_SERVER['DOCUMENT_ROOT'] no IIS
     * Essa superglobal não (??!!) está disponível no IIS (???!!!)
     *
     */
    public static function _montaServerDocumentRootIIS() {
        if (!isset($_SERVER['DOCUMENT_ROOT'])) {
            if (isset($_SERVER['SCRIPT_FILENAME'])) {
                $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF'])));
            }
            if (isset($_SERVER['PATH_TRANSLATED'])) {
                $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0 - strlen($_SERVER['PHP_SELF'])));
            }
        }
    }

    /**
     * Montao os botões para shared
     * Primeiro parametro é a url a ser compartilhada;
     * Segundo parametro é titulo do que vai ser compartilhado;
     *
     * @param string $url
     * @param string $titulo
     *
     */
    public static function _botaoShared($link, $titulo) {
        $face = '<iframe src="//www.facebook.com/plugins/like.php?href=' . urlencode(GLOBAL_PATH . $link) . '&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=23&amp;appId=429331820455639" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:23px;" allowTransparency="true"></iframe>';
        $face = '<div class="sharedFace">' . $face . '</div>';

        $twitter = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . GLOBAL_PATH . $link . '" data-text="' . $titulo . '" data-lang="pt">Tweetar</a>
                   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
        $twitter = '<div class="sharedTwitter">' . $twitter . '</div>';

        echo '<div class="shared">' . $face . $twitter . '<br class="clear" /></div>';
    }

    /**
     * Gera um token unico simples com mt_rand e sha1
     *
     * @return unknown
     */
    public static function _geraToken() {
        return strtoupper(sha1(mt_rand()));
    }

    /**
     * Função que corta texto - Retorna texto cortado
     * Primeiro parametro é o texto a ser cortado;
     * Segundo parametro é o numero de caracteres que deve ter esse texto;
     * Terceiro parametro é o que concatenar ao fim;
     * Quarto parametro é se pode cortar uma palavra no meio;
     * Quinta parametro é se pode ter elementos html
     *
     * @param string $text
     * @param int $length
     * @param sting $ending
     * @param boolean $cutWords
     * @param boolean $considerHtml
     * @return string
     */
    public static function _cortaTexto($text, $length = 100, $ending = '...', $cutWords = false, $considerHtml = true) {
        if ($considerHtml) {
            // se o texto for mais curto que $length, retornar o texto na totalidade
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            // separa todas as tags html em linhas pesquisáveis
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';

            foreach ($lines as $line_matchings) {
                // se existir uma tag html nesta linha, considerá-la e adicioná-la ao output (sem contar com ela)
                if (!empty($line_matchings[1])) {
                    // se for um "elemento vazio" com ou sem barra de auto-fecho xhtml (ex. <br />)
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // não fazer nada
                        // se a tag for de fecho (ex. </b>)
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // apagar a tag do array $open_tags
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // se a tag é uma tag inicial (ex. <b>)
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // adicionar tag ao início do array $open_tags
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // adicionar tag html ao texto $truncate
                    $truncate .= $line_matchings[1];
                }

                // calcular a largura da parte do texto da linha; considerar entidades como um caracter
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // o número dos caracteres que faltam
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // pesquisar por entidades html
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calcular a largura real de todas as entidades no alcance "legal"
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // não existem mais caracteres
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // chegamos à largura máxima, por isso saímos do loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }

                // se chegarmos à largura máxima, saímos do loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }

        // se as palavras não puderem ser cortadas a meio...
        if (!$cutWords) {
            // ...procurar a última ocorrência de um espaço...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...e cortar o texto nesta posição
                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        // adicionar $ending no final do texto
        $truncate .= $ending;

        if ($considerHtml) {
            // fechar todas as tags html não fechadas
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
        return $truncate;
    }

  /**
      * Função que quebra o link do youtube e vimeo - Retorna a variavel do video
      * Primeiro parametro é o link a ser quebrado;
      *
      * @param string $video
      * @return string
      */
     public static function _getVarVideo($video) {
         $expVideo = explode('/', $video);
         $varEmbed = $expVideo[count($expVideo) - 1];
         $varEmbed = (strpos($varEmbed, '?v=')) ? end(explode('v=', $varEmbed)) : $varEmbed;
         $varEmbed = (strpos($varEmbed, '&')) ? reset(explode('&', $varEmbed)) : $varEmbed;

         return $varEmbed;
     }

     /**
      * Função que verifica um link do youtube, vimeo, etc - Retorna o link de embed do video
      * Primeiro parametro é o link;
      *
      * Modelo Vimeo
      * //player.vimeo.com/video/$varVideo
      * 
      * Modelo Youtube
      * //www.youtube.com/embed/$varVideo
      * 
      * Modelo Dailymotion
      * //www.dailymotion.com/embed/video/$varVideo
      * 
      * @param string $video
      * @return string
      */
     public static function _getPlayerVideo($video) {
         $varEmbed = Util::_getVarVideo($video);
         
         if(strpos($video, 'youtube') !== false) {
             $player = '//www.youtube.com/embed/'.$varEmbed;
         } else if(strpos($video, 'vimeo') !== false) {
             $player = '//player.vimeo.com/video/'.$varEmbed;
         } else if(strpos($video, 'dailymotion') !== false) {
             $player = '//www.dailymotion.com/embed/video/'.$varEmbed;
         } else {
             $player = 'about:blank';
         }

         return $player;
     }

     /**
      * Função que verifica o tipo do link
      * 
      * @param string $video
      * @return string
      */
     public static function _getVideoTipo($video) {
         $varEmbed = Util::_getVarVideo($video);
         
         if(strpos($video, 'youtube') !== false) {
             $player = 'youtube';
         } else if(strpos($video, 'vimeo') !== false) {
             $player = 'vimeo';
         } else if(strpos($video, 'dailymotion') !== false) {
             $player = 'dailymotion';
         } else {
             $player = 'youtube';
         }

         return $player;
     }
      

    /**
     * FunÁao que recebe uma string e retorna um alias sem espaÁos, acentos e caracteres especiais.
     * O primeiro parametro È a String a ser formatada
     * 
     * @param string $str
     * @return String
     */
    public static function _getAlias($str) {
        $separator = "_";

        $str = Util::_lowerCase($str);
        $str = trim($str);

        $a = array(
            "/[ÂÀÁÄÃ]/" => "A",
            "/[âãàáä]/" => "a",
            "/[ÊÈÉË]/" => "E",
            "/[êèéë]/" => "e",
            "/[ÎÍÌÏ]/" => "I",
            "/[îíìï]/" => "i",
            "/[ÔÕÒÓÖ]/" => "O",
            "/[ôõòóö]/" => "o",
            "/[ÛÙÚÜ]/" => "U",
            "/[ûúùü]/" => "u",
            "/[®??©]/" => "",
            "/[ºª??]/" => "",
            "/ç/" => "c",
            "/Ç/" => "C");
        // Tira o acento pela chave do array
        $str = preg_replace(array_keys($a), array_values($a), $str);

        setlocale(LC_ALL, 'pt_BR.utf-8');
        // substitui espaÁos por undercore
        $alias = preg_replace("& &", $separator, $str);

        // retira acentos e caracteres especiais
        $alias = iconv('UTF-8', 'ASCII//TRANSLIT', $alias);

        $alias = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $alias);
        $alias = Util::_lowerCase(trim($alias, $separator));
        $alias = preg_replace("/[\/_| -]+/", $separator, $alias);


        return $alias;
    }

    public static function _urlTitle($str, $separator = '-', $lowercase = TRUE) {
        if ($separator == 'dash') {
            $separator = '-';
        } else if ($separator == 'underscore') {
            $separator = '_';
        }

        $str = preg_replace(
                array('/ä|æ|ǽ/', '/ö|œ/', '/ü/', '/Ä/', '/Ü/', '/Ö/', '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/', '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/', '/Ç|Ć|Ĉ|Ċ|Č/', '/ç|ć|ĉ|ċ|č/', '/Ð|Ď|Đ/', '/ð|ď|đ/', '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/', '/è|é|ê|ë|ē|ĕ|ė|ę|ě/', '/Ĝ|Ğ|Ġ|Ģ/', '/ĝ|ğ|ġ|ģ/', '/Ĥ|Ħ/', '/ĥ|ħ/', '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/', '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/', '/Ĵ/', '/ĵ/', '/Ķ/', '/ķ/', '/Ĺ|Ļ|Ľ|Ŀ|Ł/', '/ĺ|ļ|ľ|ŀ|ł/', '/Ñ|Ń|Ņ|Ň/', '/ñ|ń|ņ|ň|ŉ/', '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/', '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/', '/Ŕ|Ŗ|Ř/', '/ŕ|ŗ|ř/', '/Ś|Ŝ|Ş|Š/', '/ś|ŝ|ş|š|ſ/', '/Ţ|Ť|Ŧ/', '/ţ|ť|ŧ/', '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/', '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/', '/Ý|Ÿ|Ŷ/', '/ý|ÿ|ŷ/', '/Ŵ/', '/ŵ/', '/Ź|Ż|Ž/', '/ź|ż|ž/', '/Æ|Ǽ/', '/ß/', '/Ĳ/', '/ĳ/', '/Œ/', '/ƒ/'), array('ae', 'oe', 'ue', 'Ae', 'Ue', 'Oe', 'A', 'a', 'C', 'c', 'D', 'd', 'E', 'e', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'N', 'n', 'O', 'o', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'Y', 'y', 'W', 'w', 'Z', 'z', 'AE', 'ss', 'IJ', 'ij', 'OE', 'f'), $str
        );

        $q_separator = preg_quote($separator);

        $trans = array(
            '&.+?;' => '',
            '[^a-z0-9 _-]' => '',
            '\s+' => $separator,
            '(' . $q_separator . ')+' => $separator
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }

        return trim($str, $separator);
    }

    public static function _getTemplateEmail($conteudo) {
        return utf8_decode($conteudo);
    }

    public static function _utf8Array($array, $code = 'encode') {
        $i = 0;
        $array2 = array();
        foreach ($array as $linha) {
            foreach ($linha as $key => $coluna) {
                if ($code == 'encode') {
                    $array2[$i][$key] = utf8_encode($coluna);
                } else {
                    $array2[$i][$key] = utf8_decode($coluna);
                }
            }
            $i++;
        }

        return $array2;
    }

}

?>