<?php
/**
 * <b> Delete.class [ CRUD - Básico ] </b>
 * Classe responsável pela exclusão de dados em um banco.
 * [CRU] DELETE - É a útlima de um grupo CRUD
 * Possui métodos para deletar dados no banco.
 * 
 */
class Delete extends Conn {

    private $Tabela;
    private $Termos;
    private $Places;
    private $Resultados;

    /** @var PDOStatement */
    private $Delete;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeDelete:</b> Executa um delete no banco utilizando prepared statements.
     * Informar o nome da tabela, termos (ex: WHERE id = :id) e o ParseString.
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco.
     * @param STRING $Termos = Informe os termos para o DELETE.
     * @param STRING $ParseString = Variavel estilizada para o parse_str().
     */
    public function ExeDelete($Tabela, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    /** Função retorna o valor do resultado da execução da QUERY, podendo ser true ou false. */
    public function getResultado() {
        return $this->Resultados;
    }

    /** Função retorna o número de linhas afetadas após a última execução da QUERY. */
    public function getRowCount() {
        return $this->Delete->rowCount();
    }

    /** Função altera os requisitos dos termos da QUERY  e em seguida a executa. */
    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * ****************************************
     * ********** PRIVATE METHODOS ************
     * ****************************************
     */

    /**
     * Private Funcition Connect();
     * Utiliza a classe pai para realizar uma conexão ao banco de dados no padrão SingleToon.
     */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Delete = $this->Conn->prepare($this->Delete);
    }

    /**
     * Private funcrion getSyntax();
     * Prepara a QUERY para ser executada posteriormente pela funcão Execute();
     */
    private function getSyntax() {
        $this->Delete = "DELETE FROM {$this->Tabela} {$this->Termos}";
    }

    /**
     * Private function Execute();
     * Chama a funcção Connect() para realizar a conexão com o banco de dados e executa
     * a QUERY preparada.
     * Retorna o true para a execução com sucesso.
     */
    private function Execute() {
        $this->Connect();
        try {
            $this->Delete->execute($this->Places);
            $this->Resultados = true;
        } catch (PDOException $e) {
            $this->Resultado = null;
            WSErro("Erro ao deletar: {$e->getMessage()}", $e->getCode());
        }
    }

}
