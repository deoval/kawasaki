<?php

/*
 * 	Autor: Roberto Carlos
 * 	Email: rcmsjr@gmail.com
 *
 * 	Data: 03/03/2011
 *
 *      Modificado: 10/04/2014
 *      Version: 1.2
 * 
 */

class Calendario {
    // Dia da semana, representa o date('w') onde começa em 0(zero) para domingo até 6 para sabado.
    protected $dia_semana = array(0 => 'Domingo', 1 => 'Segunda - Feira', 2 => 'Terça - Feira', 3 => 'Quarta - Feira', 4 => 'Quinta - Feira', 5 => 'Sexta - Feira', 6 => 'Sábado');
    // Dia da semana, representa o date('w') onde começa em 0(zero) para domingo até 6 para sabado.
    protected $meses = array(1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro');
    protected $mes; //Mês a ser apresentado
    protected $ano; //Ano a ser apresentado
    protected $mes_anterior; //Mês anterior do que está a ser apresentado
    protected $ano_anterior; //Ano anterior é uma variavel que pode mudar dependendo do mês, pode ser igual ao atual ou 1 ano a menos
    protected $mes_proximo; //Proximo mês do que está a ser apresentado
    protected $ano_proximo; //Proximo ano é uma variavel que pode mudar dependendo do mês, pode ser igual ao atual ou 1 ano a mais
    protected $primeiro_dia_mes; // Primeiro dia do mes a ser apresentado em mktime
    protected $primeiro_dia_mes_anterior; // Primeiro dia do mes anterior a ser apresentado em mktime
    protected $num_dias_mes; // Numero de dias do mes a ser apresentado
    protected $num_dias_mes_anterior; // Numero de dias do mes anterior a ser apresentado
    protected $dia_semana_primeiro_dia_mes; //Numero do dia da semana do primeiro dia do mes a ser apresentado
    protected $dias_mes = array();
    protected $dias_mes_anterior = array();
    protected $dias_mes_proximo = array();

    /**
     * Constroi um calendario apartir dos parametros passados, caso não seja passado pegas essas infos do servidor
     *
     * @param int $mes - Mês a ser apresentado
     * @param int $ano - Ano a ser apresentado
     */
    public function __construct($mes = 0, $ano = 0){
        $this->setMes((int) $mes);
        $this->setAno((int) $ano);
        
        // Seta o mes e o ano anterior
        $this->setMesAnoAnterior();

        // Seta o proximo mes e ano
        $this->setMesAnoProximo();

        $this->setPrimeiroDiaMes();
        $this->setPrimeiroDiaMesAnterior();
        $this->setNumDiasMes();
        $this->setNumDiasMesAnterior();
        $this->setDiaSemanaPrimeiroDiaMes();
        $this->setDiasMesAnterior();
        $this->setDiasMes();
        $this->setDiasMesProximo();
    }

    //Sets
    protected function setMes($mes){
        if(intval($mes) >= 1 && intval($mes) <= 12)
            $this->mes = $mes;
        else {
            $mes = date('m');
            if($mes < 10)
                $this->mes = preg_replace("%0%", "", $mes);
        }
    }

    protected function setAno($ano){
        if(strlen((int) $ano) === 4)
            $this->ano = $ano;
        else
            $this->ano = date('Y');
    }

    protected function setMesAnoAnterior(){
        if($this->mes == 1) { // se o mes for janeiro tem que voltar para o ano anterior
            $this->mes_anterior = 12;
            $this->ano_anterior = $this->ano - 1;
        }
        else {
            $this->mes_anterior = $this->mes - 1;
            $this->ano_anterior = $this->ano;
        }
    }

    protected function setMesAnoProximo(){
        if($this->mes == 12) { // se o mes for dezembro tem que avançar um ano
            $this->mes_proximo = 1;
            $this->ano_proximo = $this->ano + 1;
        }
        else {
            $this->mes_proximo = $this->mes + 1;
            $this->ano_proximo = $this->ano;
        }
    }

    protected function setPrimeiroDiaMes(){
        $this->primeiro_dia_mes = mktime(0, 0, 0, $this->mes, 1, $this->ano);
    }

    protected function setPrimeiroDiaMesAnterior(){
        $this->primeiro_dia_mes_anterior = mktime(0, 0, 0, $this->mes_anterior, 1, $this->ano_anterior);
    }

    protected function setNumDiasMes(){
        $this->num_dias_mes = date('t', $this->primeiro_dia_mes);
    }

    protected function setNumDiasMesAnterior(){
        $this->num_dias_mes_anterior = date('t', $this->primeiro_dia_mes_anterior);
    }

    protected function setDiaSemanaPrimeiroDiaMes(){
        $this->dia_semana_primeiro_dia_mes = date('w', $this->primeiro_dia_mes);
    }

    protected function setDiasMesAnterior(){
        if($this->dia_semana_primeiro_dia_mes > 0){
            for($i = 1; $i <= $this->dia_semana_primeiro_dia_mes; $i++)
                $this->dias_mes_anterior[] = $this->num_dias_mes_anterior - ($this->dia_semana_primeiro_dia_mes - $i);
        }
    }

    protected function setDiasMes(){
        for($dia = 1; $dia <= $this->num_dias_mes; $dia++ )
            $this->dias_mes[] = $dia;
    }

    protected function setDiasMesProximo(){
        $dia = 0;
        $total = count($this->getDiasMesAnterior()) + count($this->getDiasMes());
        if($total > 35)
            $limite = 7 - (42 - $total);
        else
            $limite = 7 - (35 - $total);

        if($limite > 0){
            for($i = $limite; $i < 7; $i++)
                $this->dias_mes_proximo[] = $dia++;
        }
    }

    //Gets

    /**
     * Retorna o nome do dia da semana
     *
     * @param int $posicao - Posição do array
     *
     * @return string
     */
    public function getDiaSemana($posicao){
        $posicao = (intval($posicao) >= 0 && intval($posicao) <= 6) ? $posicao : date('w');
        return $this->dia_semana[$posicao];
    }

    /**
     * Retorna o array com os dias da semana
     *
     * @return array
     */
    public function getDiasSemana(){
        return $this->dia_semana;
    }

    /**
     * Retorna o nome do mes
     *
     * @param int $posicao - Posição do array
     *
     * @return string
     */
    public function getMeses($posicao){
        $posicao = (intval($posicao) >= 1 && intval($posicao) <= 12) ? $posicao : date('m');
        return $this->meses[$posicao];
    }

    /**
     * Retorna o todos os meses e seus nomes
     *
     * @return array
     */
    public function getNomeMeses(){
        return $this->meses;
    }

    /**
     * Retorna um array com os dias do mes anterior
     *
     * @return array
     */
    public function getDiasMesAnterior(){
        return $this->dias_mes_anterior;
    }

    /**
     * Retorna um array com os dias do mes a ser apresentado
     *
     * @return array
     */
    public function getDiasMes(){
        return $this->dias_mes;
    }

    /**
     * Retorna um array com os dias do proximo mes
     *
     * @return array
     */
    public function getDiasMesProximo(){
        return $this->dias_mes_proximo;
    }

    public function getMes(){
        return $this->mes;
    }

    public function getAno(){
        return $this->ano;
    }

    public function getMesAnterior(){
        return $this->mes_anterior;
    }

    public function getAnoAnterior(){
        return $this->ano_anterior;
    }

    public function getMesProximo(){
        return $this->mes_proximo;
    }

    public function getAnoProximo(){
        return $this->ano_proximo;
    }
}
?>