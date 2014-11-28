<?php

/*
 * 	Autor: Roberto Carlos
 * 	Email: rcmsjr@gmail.com
 *
 * 	Data: 13/09/2012
 *
 */

class Paginacao {

    private $pagina_atual = 0;
    private $limite_quantidade = 0;
    private $limite_indice = 0;
    private $limite_paginas = 10;
    private $total_registros = 0;
    private $total_paginas = 0;

    public function __construct($pagina_atual, $limite_quantidade, $total_registros, $limite_paginas = 10) {
        $this->pagina_atual = intval($pagina_atual);
        $this->limite_quantidade = intval($limite_quantidade);
        $this->setLimite_indice();
        $this->total_registros = intval($total_registros);

        $this->setTotal_paginas();
        $this->setLimite_paginas($limite_paginas);
    }

    public function getPagina_atual() {
        return $this->pagina_atual;
    }

    public function setPagina_atual($pagina_atual) {
        $this->pagina_atual = $pagina_atual;
    }

    public function getLimite_quantidade() {
        return $this->limite_quantidade;
    }

    public function setLimite_quantidade($limite_quantidade) {
        $this->limite = $limite_quantidade;
    }

    public function getLimite_indice() {
        return $this->limite_indice;
    }

    public function setLimite_indice() {
        $this->limite_indice = $this->pagina_atual > 1 ? ($this->pagina_atual - 1) * $this->limite_quantidade : 0;
    }

    public function getLimit() {
        return $this->limite_indice . "," . $this->limite_quantidade;
    }

    public function getTotal_registros() {
        return $this->total_registros;
    }

    public function setTotal_registros($total_registros) {
        $this->total_registros = $total_registros;
    }

    public function getTotal_paginas() {
        return $this->total_paginas;
    }

    public function setTotal_paginas() {
        $this->total_paginas = $this->total_registros > 0 ? ceil($this->total_registros / $this->limite_quantidade) : 1;
    }

    public function getLimite_paginas() {
        return $this->limite_paginas;
    }

    public function setLimite_paginas($limite_paginas) {
        $this->limite_paginas = $this->total_paginas > $limite_paginas ? $limite_paginas : $this->total_paginas;
    }

    public function geraPaginacao() {

        if ($this->total_paginas > 1) {
            $cont_pagina = 0;
            if ($this->total_paginas > $this->limite_paginas) {
                $cont_pagina = (ceil($this->limite_paginas / 2)) - $this->pagina_atual;
                $cont_pagina = ($cont_pagina * -1) + 1;
                
                if($cont_pagina + $this->limite_paginas > $this->total_paginas) {
                    $cont_pagina = ($this->total_paginas - $this->limite_paginas) + 1;
                }
            }

            $cont_pagina = $cont_pagina > 1 ? $cont_pagina : 1;

            $pages = array();

            for ($cont = 1; $cont <= $this->limite_paginas; $cont++) {
                $selected = $cont == $this->pagina_atual ? true : false;
                $pages[] = array(
                    'page' => $cont_pagina + ($cont-1),
                    'selected' => $selected
                );
            }
            return $pages;
        }
    }

}

?>