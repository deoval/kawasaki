<?php
/**
 * Description of classValidaFormato
 *
 * @author Roberto
 */
class VerificaFormato {
    /**
     * Verifica se o email é válido (formato)
     *
     * @param string $email
     * @return bool
     */
    public static function VerificaEmail($email) {
        if(preg_match("/^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$/",$email)) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Verifica se a url é valida (formato)
     *
     * @param string $url
     * @return bool
     */
    public static function VerificaURL($url) {
        if(preg_match('/^(http|https|ftp)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&%\$#\=~])*$/',$url) != false) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Verifica se o telefone possui 9 ou 10 digitos numéricos
     *
     * @param string $telefone
     * @return bool
     */
    public static function VerificaTelefone($telefone) {
        if(preg_match('/[0-9]{9,10}/',$telefone) != false) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Verifica o telefone com a mascara (99)9999-9999 ou (99)999-9999
     *
     * @param string $telefone
     * @return bool
     */
    public static function VerificaTelefoneMascara($telefone) {
        if(preg_match('/\([0-9]{2}\)[0-9]{4}-[0-9]{4}/',$telefone) != false) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Valida o formato do CPF.
     * Não identifica se o dígito verificador é válido
     *
     * @param string $cpf
     * @return bool
     */
    public static function VerificaCPF($cpf) {
        if(preg_match('/[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}/',$cpf) != false) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Valida o formato do CEP.
     *
     * @param string $cep
     * @return bool
     */
    public static function VerificaCEP($cep) {
        if(preg_match('/[0-9]{5}-[0-9]{3}/',$cep) != false) {
            return true;
        }else {
            return false;
        }
    }
}
?>
