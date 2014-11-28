<?php

class Componente {

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
}