<?php

/**
 * Classe para manipulação do banco de dados MySQL
 * Dados de conexão devem estar no arquivo config.php
 *
 * @version 2.3
 * @Roberto - rcmsjr@gmail.com (2010)
 * @copyright Reprodução autorizada desde que mantido dados acima.
 */
class DB {

    private static $instance;
    private $conn;
    private $result;
    private $coluns;
    private $from;
    private $where;
    private $join;
    private $order;
    private $group;
    private $having;
    private $limit;

    /**
     * Função para iniciar a instancia da classe
     * 
     * @param type $name
     * @param type $host
     * @param type $user
     * @param type $pass
     * 
     */
    /*
    public static function _getInstance($name = "", $host = "", $user = "", $pass = "") {
        if(empty(static::$instance) && !is_object(static::$instance)) {
            static::$instance = new DB($name = "", $host = "", $user = "", $pass = "");
        }
        
        return static::$instance;   
        
    }
    */

    /**
     * Inicializa as variaveis
     */
    public function __construct($name = "", $host = "", $user = "", $pass = "", $charset = "utf8") {

        /**
         * Abre a conexão ao mysql
         * @return bool
         */
        $host = $host == "" ? DB_HOST : $host;
        $user = $user == "" ? DB_USER : $user;
        $pass = $pass == "" ? DB_PASS : $pass;
        $name = $name == "" ? DB_NAME : $name;
        $charset = $charset == "" ? DB_CHARSET : $charset;

        if (!$this->conn = mysql_connect($host, $user, $pass)) {
            throw new Exception('Erro ao conectar a base de dados');
        }
        if (!mysql_select_db($name, $this->conn)) {
            throw new Exception('Erro ao selecionar a base de dados para uso Error: ' . $this->Error());
        }
        
        mysql_set_charset($charset);

        $this->coluns = "*";
        $this->from = "";
        $this->where = "";
        $this->join = "";
        $this->order = "";
        $this->group = "";
        $this->having = "";
        $this->limit = "";
    }

    //Metodos de limpeza
    public function clearSelect() {
        $this->coluns = "";
        $this->where = "";
        $this->join = "";
        $this->order = "";
        $this->group = "";
        $this->having = "";
        $this->limit = "";
    }

    public function clearColuns() {
        $this->coluns = "";
    }

    public function clearWhere() {
        $this->where = "";
    }

    public function clearJoin() {
        $this->join = "";
    }

    public function clearOrder() {
        $this->order = "";
    }

    public function clearGroup() {
        $this->group = "";
    }

    public function clearHaving() {
        $this->having = "";
    }

    public function clearLimit() {
        $this->limit = "";
    }

    //Metodos Sets
    public function setColuns($value) {
        $this->coluns = $value;
        return $this;
    }

    public function setFrom($value) {
        $this->from = $value;
        return $this;
    }

    public function setWhere($value) {
        $this->where .= $value;
        return $this;
    }

    public function setJoin($value) {
        $this->join .= " " . $value;
        return $this;
    }

    public function setOrder($value) {
        $this->order = $value;
        return $this;
    }

    public function setGroup($value) {
        $this->group = $value;
        return $this;
    }

    public function setHaving($value) {
        $this->having .= $value;
        return $this;
    }

    public function setLimit($value) {
        $this->limit = $value;
        return $this;
    }

    //Metodos Sets
    public function getColuns() {
        return $this->coluns;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getWhere() {
        return $this->where;
    }

    public function getJoin() {
        return $this->join;
    }

    public function getOrder() {
        return $this->order;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getHaving() {
        return $this->having;
    }

    public function getLimit() {
        return $this->limit;
    }

    /**
     * Retorna esta conexão ao banco de dados
     *
     * @return resource
     */
    public function Conn() {
        return $this->conn;
    }

    /**
     * Fecha a conexão ao mysql
     *
     * @return bool
     */
    public function Close() {
        return @mysql_close($this->conn);
    }

    /**
     * Inicia uma transação de banco de dados
     *
     */
    public function StartTransaction() {
        if (!mysql_query('START TRANSACTION', $this->conn)) {
            throw new Exception('Erro ao iniciar a transação');
        }
    }

    /**
     * Executa o ROLLBACK na transação atual
     *
     */
    public function Rollback() {
        if (!mysql_query('ROLLBACK')) {
            throw new Exception('Erro ao executar o cancelamento da transação');
        }
    }

    /**
     * Executa o COMMIT da transação atual
     *
     */
    public function Commit() {
        if (!mysql_query('COMMIT')) {
            throw new Exception('Erro ao salvar os dados da transação');
        }
    }

    /*     * ************* methods ********************* */

    /**
     * Executa um comando SQL no banco de dados
     *
     * @param string $sql
     * @return resource
     */
    public function Query($sql) {
        
        if (!$this->result = mysql_query($sql, $this->conn)) {
            return false;
        } else {
            return $this->result;
        }
    }

    /**
     * Retorna uma linha de resultado por chamada
     *
     * @return object
     */
    public function Fetch() {
        return mysql_fetch_object($this->result);
    }

    /**
     * Retorna uma linha de resultado por chamada
     *
     * @return array
     */
    public function FetchArray() {
        return mysql_fetch_array($this->result);
    }

    /**
     * Retorna um array para multiplos resultados
     * @param string $sql comando select
     * @return array
     */
    public function getArrayBySelect($sql) {
        if ($this->Query($sql)) {
            $i = 0;
            while ($linha = $this->FetchArray()) {
                $rsArray[$i] = $linha;
                $i++;
            }
            //$this->Close();
            return isset($rsArray) && is_array($rsArray) ? $rsArray : '';
        } else
            throw new Exception("Erro ao executar a query: " . $sql . " Error: " . $this->Error());
    }

    /**
     * Retorna o número de linhas retornadas pela consulta SQL ou número de linhas modificadas por comandos como UPDATE e DELETE
     *
     * @return int
     */
    public function NumRows() {
        return mysql_num_rows($this->result);
    }

    /**
     * Retorna a mensagem de erro do mysql
     *
     * @return string
     */
    public function Error() {
        return mysql_error($this->Conn());
    }

    /**
     * Retorna o último autoincrement gerado
     *
     * @return int
     */
    public function LastInsertId() {
        return mysql_insert_id($this->conn);
    }

    /**
     * Função que pega o nome dos campos de uma tabela
     * @param string
     * @return string
     */
    public function Fields($value) {
        return "SHOW COLUMNS FROM " . $value;
    }
    
    /**
     * Função que pega o nome das tabelas de um banco
     * @return array
     */
    public function Tables() {
        return "SHOW TABLES";
    }

    public function Select() {

        $sql = "SELECT " . $this->getColuns() . " FROM " . $this->getFrom() . " " . $this->getJoin();
        if ($this->getWhere() != "")
            $sql .= " WHERE 1 " . $this->getWhere();

        if ($this->getGroup() != "")
            $sql .= " GROUP BY " . $this->getGroup();

        if ($this->getHaving() != "")
            $sql .= " HAVING 1 " . $this->getHaving();

        if ($this->getOrder() != "")
            $sql .= " ORDER BY " . $this->getOrder();

        if ($this->getLimit() != "")
            $sql .= " LIMIT " . $this->getLimit();

        return $sql;
    }

}

?>