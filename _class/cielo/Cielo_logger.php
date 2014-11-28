<?php

class Cielo_logger {

    private $log_file =  "cielo-xml.log";
    private $fp = null;

    public function logOpen() {
        $this->fp = fopen(LOCAL_LOG.$this->log_file, 'a');
    }

    public function logWrite($strMessage, $transacao) {
        if (!$this->fp)
            $this->logOpen();

        $path = $_SERVER["REQUEST_URI"];
        $data = date("Y-m-d H:i:s:u (T)");

        $log = "***********************************************" . "\n";
        $log .= $data . "\n";
        $log .= "DO ARQUIVO: " . $path . "\n";
        $log .= "OPERAÇÃO: " . $transacao . "\n";
        $log .= $strMessage . "\n\n";

        fwrite($this->fp, $log);
    }

}

?>