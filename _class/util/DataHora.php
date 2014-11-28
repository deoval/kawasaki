<?php

/**
 * Classe para manipulação de data e hora no intervalo do mktime Unix
 * 
 * @author Anderson Ceresa
 *
 */
class DataHora {

    private $mktime; //mktime

    /**
     * Manipula data e hora.
     * Se o parametro foi informado, utilizará como data e hora
     * O formato deve ser ANO-MES-DIA HORA:MINUTO:SEGUNDO
     * 
     * Ex.: 
     * 2000-03-15 21:34:12 - data e hora
     * 2000-03-15 00:00:00 - somente data
     * 
     * @param string|null $dh
     */

    public function __construct($dStart = null) {
        if ($dStart === null) {
            $this->mktime = $this->ConverteMktime(date('Y-m-d H:i:s'));
        } else {
            if (!preg_match("&([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})&", $dStart)) {
                throw new Exception("Data em formato inválido: " . $dStart);
            }
            $this->mktime = $this->ConverteMktime($dStart);
        }
    }

    /**
     * Converte em mktime uma data/hora no formato ANO-MES-DIA HORA:MINUTO:SEGUNDO
     *
     * @param string $dStart
     * @return int
     */
    protected function ConverteMktime($dStart) {

//separa a data da hora
        $dh = explode(' ', $dStart);
        $data = explode('-', $dh[0]);
        $hora = explode(':', $dh[1]);

//verifica se a data é valida se for diferente de 0000-00-00
        if ($dh[0] != '0000-00-00') {
            if (!checkdate($data[1], $data[2], $data[0])) {
                throw new Exception("Data inválida: " . $dh[0]);
            }
        } else {
            return 0;
        }

        if (($hora[0] < 0 || $hora[0] > 23) || ($hora[1] < 0 || $hora[1] > 59) || ($hora [2] < 0 || $hora[2] > 59)) {
            throw new Exception("Hora inválida: " . $dh[1]);
        }
        return mktime($hora[0], $hora[1], $hora[2], $data[1], $data [2], $data[0]);
    }

    /**
     * Data no formato DIA/MES/ANO
     *
     * @return string
     */
    public function DataPortugues() {
        return $this->mktime != 0 ? date('d/m/Y', $this->mktime) : '00/00/0000';
    }

    /**
     * Data no formato ANO-MES-DIA
     *
     * @return string
     */
    public function DataISO() {
        return $this->mktime != 0 ? date('Y-m-d', $this->mktime) : '0000-00-00';
    }

    /**
     * Data e hora no formato DIA/MES/ANO HORA:MINUTO:SEGUNDO
     *
     * @param bool $segundos
     * @return string
     */
    public function DataHoraPortugues($segundos = true) {
        return $segundos ? $this->mktime != 0 ? date('d/m/Y H:i:s', $this->mktime) : '00/00/0000 00:00:00' : "{$this->
                        DataPortugues()} {$this->HoraMinuto()}";
    }

    /**
     * Data e hora no formato ANO-MES-DIA HORA:MINUTO:SEGUNDO
     *
     * @return string
     */
    public function DataHoraISO() {
        return $this->mktime != 0 ? date('Y-m-d H:i:s', $this->mktime) : '0000-00-00 00:00:00';
    }

    /**
     * hora completa no formato HORA:MINUTO:SEGUNDO
     *
     * @return string
     */
    public function HoraCompleta() {
        return $this->mktime != 0 ? date('H:i:s', $this->mktime) : '00:00:00';
    }

    /**
     * hora e minutos no formato HORA:MINUTO
     *
     * @return string
     */
    public function HoraMinuto() {
        return $this->mktime != 0 ? date('H:i', $this->mktime) :
                '00:00';
    }

    /**
     * Retorna o dia do mes de 01 a 31
     *
     * @return string|int
     */
    public function Dia() {
        return $this->mktime != 0 ? date('d', $this->mktime) : '00';
    }

    /**
     * Retorna o mes em numero 01 a 12
     *
     * @return string|int
     */
    public function Mes() {
        return $this->mktime != 0 ? date('m', $this->mktime) : '00';
    }

    /**
     * Retorna o ano em 4 digitos
     *
     * @return string|int
     */
    public function Ano4() {
        return $this->mktime != 0 ? date('Y', $this->mktime) : '0000';
    }

    /**
     * Retorna o ano em 2 digitos
     *
     * @return string|int
     */
    public function Ano2() {
        return $this->mktime != 0 ? date('y', $this->mktime) : '00';
    }

    /**
     * Hora no formato 24 horas. De 00 a 23
     *
     * @return string|int
     */
    public function Hora24() {
        return $this->mktime != 0 ? date('H', $this->mktime) : '00';
    }

    /**
     * Hora no formato 12 horas. De 01 a 12
     *
     * @return string|int
     */
    public function Hora12() {
        return $this->mktime != 0 ? date('h', $this->mktime) : '00';
    }

    /**
     * Minuto da hora. De 00 a 59
     *
     * @return string|int
     */
    public function Minuto() {
        return $this->mktime != 0 ? date('i', $this->mktime) : '00';
    }

    /**
     * Segundos da hora. De 00 a 59
     *
     * @return string|int
     */
    public function Segundo() {
        return $this->
                mktime != 0 ? date('s', $this->mktime) : '00';
    }

    /**
     * Antes ou depois do meio dia. AM/PM
     *
     * @return string
     */
    public function AmPm() {
        return date('A', $this->mktime);
    }

    /**
     * Numero de dias do mes. De 28 a 31
     *
     * @return int
     */
    public function TotalDiasMes() {
        return $this->mktime != 0 ? date('t', $this->mktime) : 0;
    }

    /**
     * Numero da semana do ano. Semana começando na segunda
     *
     * @return int
     */
    public function SemanaAno() {
        return $this->mktime != 0 ? date('W', $this->mktime) : 0;
    }

    /**
     * Dia da semana em número. 0 domingo 6 sabado
     *
     * @return int
     */
    public function DiaSemana() {
        return $this->mktime != 0 ? date('w', $this->mktime) : -1;
    }

    /**
     * Dia do ano. de 1 a 366
     *
     * @return int
     */
    public function DiaAno() {
        return $this->mktime != 0 ?
                date('z', $this->mktime) + 1 : 0;
    }

    /**
     * timezone da data. UTC/GMT/ETC...
     *
     * @return string
     */
    public function Timezone() {
        return date('e', $this->mktime);
    }

    /**
     * Se está ou não no horario de verao
     *
     * @return bool
     */
    public function HorarioVerao() {
        return date('I', $this->mktime) == 1 ? true : false;
    }

    /**
     * Se esta ou nao em um ano bissexto
     *
     * @return bool
     */
    public function AnoBissexto() {
        return date('L', $this->mktime) == 1 ? true : false;
    }

    /**
     * Retorna o mktime() da data
     *
     * @return int
     */
    public function MkTime() {
        return $this->mktime;
    }

    /**
     * Dia da semana em portugues. Domingo a sábado
     *
     * @return string
     */
    public function DiaSemanaPortugues() {
        switch ($this->DiaSemana()) {
            case 0:return "Domingo";
                break;
            case 1:

                return "Segunda-feira";
                break;
            case 2:return "Terça-feira";
                break;
            case 3:return "Quarta-feira";
                break;
            case 4:return "Quinta-feira";
                break;
            case 5:return "Sexta-feira";
                break;
            case 6:return "Sábado";
                break;
            default:return null;
        }
    }

    /**
     * Mes em portugues. Janeiro a dezembro
     *
     * @return string
     */
    public function MesPortugues($idioma = 'portugues') {
        if ($idioma == 'ingles') {
            switch ($this->Mes()) {
                case 1: return "January";
                    break;
                case 2: return "February";
                    break;
                case 3: return "March";
                    break;
                case 4: return "April ";
                    break;
                case 5: return "May";
                    break;
                case 6: return "June";
                    break;
                case 7: return "July";
                    break;
                case 8: return "August";
                    break;
                case 9: return "September";
                    break;
                case 10:return "October";
                    break;
                case 11:return "November";
                    break;
                case 12:return "December";
                    break;
                default: return null;
            }
        } else {
            switch ($this->
                    Mes()) {
                case 1: return "Janeiro";
                    break;
                case 2: return "Fevereiro";
                    break;
                case 3: return "Março";
                    break;
                case 4: return "Abril";
                    break;
                case 5: return "Maio";
                    break;
                case 6: return "Junho";
                    break;
                case 7: return "Julho";
                    break;
                case 8: return "Agosto";
                    break;
                case 9: return "Setembro";
                    break;
                case 10:return "Outubro";
                    break;
                case 11:return "Novembro";
                    break;
                case 12:return "Dezembro";
                    break;
                default: return null;
            }
        }
    }

    /**
     * Soma x dias a data atual
     *
     * @param int $dias
     */
    public function

    SomaDia($dias) {
        if ($dias < 0) {
            throw new

            Exception('Número de dias deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo(), $this->Mes(), $this->Dia() + $dias, $this->Ano4());
    }

    /**
     * Soma x meses a data atual
     *
     * @param int $meses
     */
    public function SomaMes($meses) {
        if ($meses < 0) {
            throw new Exception(
            'Número de meses deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo(), $this->Mes() + $meses, $this->Dia(), $this->Ano4());
    }

    /**
     * Soma x anos a data atual
     *
     * @param int $anos
     */
    public function SomaAno($anos) {
        if ($anos < 0) {
            throw new Exception('Número de anos deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo(), $this->Mes(), $this->Dia(), $this->Ano4() + $anos);
    }

    /**
     * Soma x horas a data atual
     *
     * @param int $horas
     */
    public function SomaHora($horas) {
        if ($horas < 0) {
            throw new Exception('Número de horas deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24() + $horas, $this->Minuto(), $this->Segundo(), $this->Mes(), $this->
                        Dia(), $this->Ano4());
    }

    /**
     * Soma x minutos a data atual
     *
     * @param int $min
     */
    public function SomaMinuto($min) {
        if ($min < 0) {
            throw new Exception('Número de minutos deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto() + $min, $this->Segundo(), $this->Mes(), $this->Dia(), $this->Ano4());
    }

    /**
     * Soma x segundos a data atual
     *
     * @param int $seg
     */
    public function SomaSegundo($seg) {
        if ($seg < 0) {
            throw new Exception('Número de segundos deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo() + $seg, $this->Mes(), $this->Dia(), $this->Ano4());
    }

    /**
     * Subtrai x dias a data atual
     *
     * @param int $dias
     */
    public function SubtraiDia($dias) {
        if ($dias < 0) {
            throw new Exception('Número de dias deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo(), $this->Mes(), $this->Dia() - $dias, $this->Ano4());
    }

    /**
     * Subtrai x meses a data atual
     *
     * @param int $meses
     */
    public function SubtraiMes($meses) {
        if ($meses < 0) {
            throw new Exception('Número de meses deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo(), $this->Mes() - $meses, $this->Dia(), $this->Ano4());
    }

    /**
     * Subtrai x anos a data atual
     *
     * @param int $anos
     */
    public function SubtraiAno($anos) {
        if ($anos < 0) {
            throw new Exception('Número de anos deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo(), $this->Mes(), $this->Dia(), $this->Ano4() - $anos);
    }

    /**
     * Subtrai x horas a data atual
     *
     * @param int $horas
     */ public function SubtraiHora($horas) {
        if ($horas < 0) {
            throw

            new Exception('Número de horas deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24() - $horas, $this->Minuto(), $this->Segundo(), $this->Mes(), $this->Dia(), $this->Ano4());
    }

    /**
     * Subtrai x minutos a data atual
     *
     * @param int $min
     */ public function SubtraiMinuto($min) {
        if ($min < 0) {
            throw new Exception(
            'Número de minutos deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto() - $min, $this->Segundo(), $this->Mes(), $this->Dia(), $this->Ano4());
    }

    /**
     * Subtrai x segundos a data atual
     *
     * @param int $seg
     */ public function SubtraiSegundo($seg) {
        if ($seg < 0) {
            throw new Exception('Número de segundos deve ser maior ou igual a zero');
        }
        $this->mktime = mktime($this->Hora24(), $this->Minuto(), $this->Segundo() - $seg, $this->Mes(), $this->Dia(), $this->Ano4());
    }

    /**
     * ## FUNCOES ESTATICAS
     */

    /**
     * Retorna a data e hora atual no formato ANO-MES-DIA HORA:MINUTO:SEGUNDO
     *
     * @return string
     */
    public static function Now() {
        return date('Y-m-d H:i:s');
    }

    /**
     * Retorna o mktime() atual
     *
     * @return int
     */
    public static function NowMkTime() {
        return

                mktime();
    }

    /**
     * Entra no formato DD/MM/AAAA e sai AAAA-MM-DD
     *
     * @param string $data
     * @return string
     */
    public static function DatePtToDateMysql($data) {
        $ex = explode(" ", $data);
        $h = isset($ex[1]) && $ex[1] != "" ? " " . $ex [1] : "";
        return ( implode('-', array_reverse(explode('/', $ex[0])))) . $h;
    }

    /**
     * Entra no formato AAAA-MM-DD  e sai DD/MM/AAAA
     *
     * @param string $data
     * @return string
     */
    public static function DateMysqlToDatePt($data) {
        return implode('/', array_reverse(explode('-', $data)));
    }

    /**
     * Entra no formato AAAA-MM-DD  e sai DD/MM/AAAA
     *
     * @param string $data
     * @return string
     */ public static function DateMysqlToDatePtHora($data) {
        $date = explode(" ", $data);
        return implode('/', array_reverse(explode('-', $date[0])
                )) . " " . $date[1];
    }

    /**
     * Testa se uma data ISO(aaaa-mm-dd) é válida
     *
     * @param string $data
     * @return bool
     */
    public static function VerificaDataISO($data) {
        $d = explode('-', substr($data, 0, 10));
        return checkdate($d[1], $d[2], $d[0]);
    }

}

?>