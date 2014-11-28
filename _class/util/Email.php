<?php

class Email {

    private $assunto;
    private $destinatario;
    private $template;
    private $vars = array();
    private $conteudo;

    public function __construct() {
        
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function send() {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        if (MAIL_AUTH == true) {
            $mail->SMTPAuth = MAIL_AUTH;
            $mail->Host = MAIL_HOST;
            $mail->Username = MAIL_USER;
            $mail->Password = MAIL_PASS;
        }
        $mail->From = MAIL_FROM;
        $mail->FromName = MAIL_FROMNAME;
        $mail->Port = MAIL_PORT;
        $mail->AddAddress($this->destinatario);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $this->assunto;
        $mail->Body = $this->getBody();
        $enviado = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        if ($enviado)
            return true;
        else
            return false;
    }

    public function addVar($index, $value) {
        $this->vars[$index] = $value;
    }

    private function getBody() {
        if (trim($this->conteudo) == '') {
            $body = file_get_contents($this->template);
            if (is_array($this->vars) and count($this->vars) > 0) {
                foreach ($this->vars as $chave => $valor) {
                    $body = str_replace($chave, $valor, $body);
                }
            }
            return $body;
        } else {
            return $this->conteudo;
        }
    }

}

?>