<?php

class _Componente {

    /**
     * Monta uma div
     * Retorna uma div
     *
     * @param string $conteudo conteudo que vai dentro da div
     * @param string $class classe css da div
     * @param string $attr atributos da div
     * @param string $id id da div
     *
     * @return string
     */
    public static function _div($conteudo, $class = "", $attr = array("style" => "float:left"), $id = "") {

        $div = "<div ";
        if ($id)
            $div .= "id=\"" . $id . "\" ";

        $div .= "class=\"" . $class . "\" ";
        if ($attr)
            foreach ($attr as $at => $valor) {
                $div .= $at . " = \"" . $valor . "\" ";
            }

        $div .= "> " . $conteudo . " </div>";

        return $div;
    }

    /**
     * Monta um br com clear
     * Retorna uma div
     * @param $loop loop de br
     * @return string
     */
    public static function _br($loop = 1) {
        $b = "";
        for ($i = 1; $i <= $loop; $i++)
            $b .= "<br style=\"clear:both\"/>";
        return $b;
    }

    /**
     *
     * @param string $cor
     * @return string
     */
    public static function _hr($cor = "#cccccc") {
        return "<hr <hr color=\"" . $cor . "\" style=\"clear:both\" />";
    }

    /**
     * Monta um espaco com uma div
     * @param int $w
     * @param int $h
     * @param string $float
     * @param array $attr
     * @return string
     */
    public static function _space($w="30", $h="11", $float="left", $attr = false) {

        $div = "<div style=\"float:" . $float . ";width:" . $w . "px;height:" . $h . "px;\"";

        if ($attr)
            foreach ($attr as $at => $valor) {
                $div .= $at . " = \"" . $valor . "\" ";
            }

        $div .= "> &nbsp; </div>";

        return $div;
    }

    /**
     * Monta uma label com um texto dentro
     *
     * @param string $texto Texto da label
     * @param string $class stilo da largura
     * @param string for do label
     * @return string
     */
    public static function _label($texto = "&nbsp", $class = "", $for = false) {

        $label = "<label ";
        if ($class)
            $label .= "class = \"" . $class . "\" ";

        if ($for)
            $label .= "for = \"" . $for . "\" style='cursor:pointer;' ";
        else
            $label .= " style='cursor:default;' ";
        $label .= ">";
        $label .= $texto;
        $label .= "</label><br />";

        return $label;
    }

    /**
     * Abre um form
     * @param string $nome (name + id)
     * @param string $onsubmit
     * @param string $enctype
     * @param string $action
     * @param string $target
     * @param string $method
     * @return string
     */
    public static function _formOpen($nome = "", $onsubmit = "", $enctype=false, $action="controller.php", $target="actionFrame", $method="post") {

        $tag = "<form ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";
        $tag .= "action = \"" . $action . "\" target = \"" . $target . "\" ";
        $tag .= "method = \"" . $method . "\" onsubmit = \"" . $onsubmit . "\" ";
        if ($enctype)
            $tag .= " enctype=\"multipart/form-data\" ";
        $tag .= ">";

        return $tag;
    }

    /**
     * Fecha form
     * @return string
     */
    public static function _formClose() {
        return "</form>";
    }

    /**
     * Monta um campo input
     * Retorna uma label e um input text
     *
     * @param string $nome name e id do input
     * @param string $value valor do input
     *
     * @return string
     */
    public static function _inputHidden($nome, $value, $attr = "") {


        $tag = "<input type='hidden' ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";
        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        if ($value)
            $tag .= "value = \"" . $value . "\" ";

        $tag .= "/>";

        return $tag;
    }

    /**
     * Monta um campo input
     * Retorna uma label e um input text
     *
     * @param string $nome name e id do input
     * @param string $value valor do input
     * @param string $class classe css do input
     * @param array  $attr atributos para o input
     *
     * @return string
     */
    public static function _inputText($nome, $value = "", $class = "w420", $attr = "") {

        $tag = "<input type='text' ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";
        $tag .= "class = \"" . $class . "\" ";
        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        if ($value)
            $tag .= "value = \"" . htmlentities($value) . "\" ";

        $tag .= "/>";

        return $tag;
    }

    /**
     * Monta um campo input sem Id
     * Retorna uma label e um input text
     *
     * @param string $nome name do input
     * @param string $value valor do input
     * @param string $class classe css do input
     * @param array  $attr atributos para o input
     *
     * @return string
     */
    public static function _inputTextSemId($nome, $value = "", $class = "w420", $attr = "") {

        $tag = "<input type='text' ";
        $tag .= "name = \"" . $nome . "\" ";
        $tag .= "class = \"" . $class . "\" ";
        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        if ($value)
            $tag .= "value = \"" . htmlentities($value) . "\" ";

        $tag .= "/>";

        return $tag;
    }

    /**
     * Monta um campo input para senha
     * Retorna uma label e um input text
     *
     * @param string $nome name e id do input
     * @param string $class classe css do input
     * @param array $attr array
     *
     * @return string
     */
    public static function _inputPsw($nome, $class = "w420", $attr = "") {
        $tag = "<input type='password' ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";
        $tag .= "class = \"" . $class . "\" ";
        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        if ($value)
            $tag .= "value = \"" . $value . "\" ";

        $tag .= "/>";

        return $tag;
    }

    /**
     * Monta um campo textarea
     * Retorna uma label e um textarea
     *
     * @param string $nome name e id do Textarea
     * @param string $value valor do Textarea
     * @param string $class classe css do Textarea
     * @param string $rows altura do Textarea
     * @param array $attr array
     *
     * @return string
     */
    public static function _textarea($nome, $value = "", $class = "w370", $rows = 3, $attr = "") {
        $tag = "<textarea name=\"" . $nome . "\" id=\"" . $nome . "\" rows=\"" . $rows . "\" ";
        if ($attr) {
            foreach ($attr as $at => $valor)
                $tag .= $at . " = '" . $valor . "' ";
        }

        $tag .= "class = \"" . $class . "\" >";

        if ($value)
            $tag .= $value;

        $tag .= "</textarea>";

        return $tag;
    }

    /**
     * Monta a lista de options de uma combobox html com base em uma consulta a banco de dados
     * Retorna a lista de options ou um options com a mensagem ERRO em caso de erro na consulta SQL
     *
     * @param string $nome name e id do Select
     * @param string $options da Select
     * @param string $class classe css do Select
     * @param array  $attr atributos para o Select
     * @return string
     */
    public static function _select($nome, $options, $class = "s195", $attr = "") {

        $tag = "<select ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";
        $tag .= "class = \"" . $class . "\" ";
        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        $tag .= ">";
        $tag .= $options;
        $tag .= "</select>";

        return $tag;
    }

    /**
     * Monta  a lista de options de uma select html com base em uma consulta a banco de dados
     * Retorna a lista de options ou um options com a mensagem ERRO em caso de erro na consulta SQL
     *
     * @param string $array array com resultados
     * @param string $value valor do Select
     * @return string
     */
    public static function _options($array, $value = 0, $placeholder = 'Selecione...', $encoded = true) {
        $tag = "";
        
        if($placeholder)
            $tag = "<option value='0'>".$placeholder."</option>";

        if(count($array) > 0) {
            foreach ($array as $dado) {
                if($encoded)
                    $dado[1] = utf8_encode($dado[1]);
                
                $tag .= "<option value=\"" . $dado[0] . "\" ";
                if ($dado[0] === $value)
                    $tag .= "selected=\"selected\"";
                
                $tag .= "> " . $dado[1] . " </option>";
            }
        }

        return $tag;
    }

    /**
     * Monta  a lista de options de uma combobox html com base em uma consulta a banco de dados
     * Retorna a lista de options ou um options com a mensagem ERRO em caso de erro na consulta SQL
     *
     * @param string $value valor inicial checado na option
     * @param string $class classe css do Select
     * @return string
     */
    public static function _comboEstado($value = "RS", $class = "s195") {

        $tag = "<select ";
        $tag .= "name = 'uf' id = 'uf' ";
        $tag .= "class = \"" . $class . "\" ";
        $tag .= ">";

        if ($value == "")
            $value = 'RS';

        $tag .= "<option value=''>Selecione...</option>";

        $db = new DB();
        $query = "SELECT uf, nome FROM estado ORDER BY nome ASC";
        $db->Sql($query);
        while ($dado = $db->FetchArray()) {
            $tag .= "<option value=\"" . $dado[0] . "\" ";
            if ($dado[0] == $value)
                $tag .= "selected='selected\"";
            $tag .= "> " . $dado[1] . " </option>";
        }

        $tag .= "</select>";

        return $tag;
    }

    /**
     * Retorna os radios de todos as opções
     * @param string $name nome dos radios
     * @param string $valor valor para ser checado
     * @param array $attr array com os valores e textos
     * @example $tag .= Componente::_inputRadio("ativo",$obj->ativo,array(array("value" => "S", "texto" => "Sim"),array("value" => "N", "texto" => "Não")));
     * @return string
     */
    public static function _radio($name, $valor, $attr = "") {
        $tag = "";
        $cont = 1;
        foreach ($attr as $at) {
            $tag .= "<label for=\"" . $name . $cont . "\" style='cursor: pointer;'>";
            $tag .= "<input type='radio' ";
            $tag .= "name = \"" . $name . "\" id = \"" . $name . $cont . "\" ";
            $tag .= "value = \"" . $at["value"] . "\" ";
            if ($valor == $at["value"])
                $tag .= "checked='checked' ";
            $tag .= " style='' />&nbsp;&nbsp;";
            $tag .= $at["texto"] . "</label>&nbsp;&nbsp;&nbsp;";
            $cont++;
        }

        return $tag;
    }

    /**
     * Retorna o checkbox de todos as opções
     * @param string $name nome do checkbox
     * @param string $id id do checkbox
     * @param string $valor valor
     * @param string $valorSetado valor setado
     * @param $texto texto do checkbox
     * @param $class classe css da label
     * @param array  $attr atributos do checkbox
     * @return string
     */
    public static function _checkbox($name, $id = "", $valor = "", $valorSetado = "", $texto = "", $class = "", $attr = "") {
        $tag = "<label for=\"" . $id . "\" style='cursor: pointer;'";
        if ($class != "")
            $tag .= "class='".$class."' ";
         $tag .= ">";
        $tag .= "<input type='checkbox' ";
        $tag .= "name = \"" . $name . "\" id = \"" . $id . "\" ";
        $tag .= "value = \"" . $valor . "\" ";
        if ($valor == $valorSetado)
            $tag .= "checked='checked' ";

        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        $tag .= " />&nbsp;&nbsp;";
        $tag .= $texto . "</label>";

        return $tag;
    }

    /**
     *  Monta um campo file
     *
     * @param string $nome name e id do botao
     * @param string $class stilo da largura
     * @param array  $attr atributos para o botao
     *
     * @return string
     */
    public static function _file($nome, $class = "w370", $size = "49") {


        $tag = "<input type='file' ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";

        $tag .= "class = \"" . $class . "\" ";
        $tag .= "size = \"" . $size . "\" ";

        $tag .= "/>";

        return $tag;
    }

    /**
     *  Monta um botao
     *
     * @param string $nome name e id do botao
     * @param string $value valor do botao
     * @param string $class stilo da largura
     * @param array  $attr atributos para o botao
     * @param string  $img imagem do botão
     *
     * @return string
     */
    public static function _botao($nome = "", $value = "", $class = "w120 btnDestaque", $attr = false, $img = "", $h=false) {
        $tag = "";
        if ($h)
            $tag .= "<div style='height: 10px;width:10px'></div>";

        $tag .= "<button type='button'  ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";

        $tag .= "class = \"" . $class . "\" ";

        if ($attr) {
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }
        }

        $tag .= "><span class=\"ui-button-text\">";
        if ($img != "")
            $tag .= "<img src=\"" . ADMIN_IMG . $img . ".png\" width=\"13\" alt=\"" . strip_tags($value) . "\" align=\"absmiddle\" />";

        $tag .= " " . $value . "</span> </button>";


        return $tag;
    }

    /**
     *  Monta um submit
     *
     * @param string $nome name e id do botao
     * @param string $value valor do botao
     * @param string $class stilo da largura
     * @param array  $attr atributos para o botao
     *
     * @return string
     */
    public static function _submit($nome, $value = "Salvar", $class = "w120 btnDestaque", $attr = false, $img = "disk", $h=false) {
        $tag = "";
        if ($h)
            $tag .= "<div style='height: 10px;width:10px'></div>";

        $tag .= "<button type='submit'  ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";

        $tag .= "class = \"" . $class . "\" ";

        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        if ($value)
            $tag .= "value = \"" . $value . "\" ";


        $tag .= "><span class=\"ui-button-text\">";
        if ($img != "")
            $tag .= "<img src=\"" . ADMIN_IMG . $img . ".png\" width=\"14\" alt=\"" . strip_tags($value) . "\" align=\"absmiddle\" />";

        $tag .= " " . $value . "</span> </button>";

        return $tag;
    }

    /**
     *  Monta um botao img
     *
     * @param string $nome name e id do botao
     * @param string $value valor do botao
     * @param string $class stilo da largura
     * @param array  $src caminho da imagem do botao
     * @param array  $attr atributos para o botao
     *
     * @return string
     */
    public static function _botaoImg($nome, $value, $class = "w100", $src, $attr = "") {


        $tag = "<input type='image' ";
        $tag .= "name = \"" . $nome . "\" id = \"" . $nome . "\" ";

        $tag .= "class = \"" . $class . "\" ";

        if ($attr)
            foreach ($attr as $at => $valor) {
                $tag .= $at . " = \"" . $valor . "\" ";
            }

        if ($value)
            $tag .= "value = \"" . $value . "\" ";

        if ($src)
            $tag .= "src = \"" . $src . "\" ";

        $tag .= "/>";

        return $tag;
    }

    /**
     * Monta Campo para importação de imagem simples
     * @param string $img imagem
     * @param string $campoFile conponente file
     * @param string $excluir excluir foto
     * @param string $w largura
     * @return string
     */
    public static function _upImgSimples($imagem = "", $campoFile, $button = "", $w = "427") {

        if ($imagem == "")
            $img = ADMIN_IMG . "default_icon.jpg";
        else
            $img = ARQ . $imagem;

        $componente = "
        <table  border=\"0\" style=\"width:" . $w . "px;height:130px;border:1px solid #CCCCCC;\">
            <tr>
                <td align=\"center\" style=\"width:130px;border-right:1px solid #CCCCCC;\">
                    <img src=\"" . $img . "\" alt=\"\"/>
                </td>
                <td align=\"center\">" . $campoFile ;

        if ($button != "" && $imagem != "")
            $componente .= "<br /><br /><br />".$button;

        $componente .= "
                </td>
            </tr>
        </table>";

        return $componente;
    }

}

?>