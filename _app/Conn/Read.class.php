<?php

/**
 * <b> Read.class [ CRUD - Básico ] </b>
 * Classe responsável pela leitura de dados em um banco.
 * [C] Read [UD] - É a segunda de um grupo CRUD
 * Possui métodos para ler dados com ou sem argumentos e uma para consultas totalmente manuais. 
 * 
 */
class Read extends Conn {

    private $Select;
    private $Tabela;
    private $Colunas;
    private $Termos;
    private $Places;
    private $Resultado;

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeRead</b> : Executa uma consulta genérico no banco de dados utilizando prepares statements.
     * Informe:
     * @param STRING $Tabela = Nome da tabela no Banco.
     * @param STRING $Colunas = Colunas a serem recuperadas no banco de dados, passe null para setar todas as colunas.
     * @param STRING $Termos = Termos com argumentos para a consulta Ex:WHERE 1=1;
     * @param STRING $ParseString = Argumentos utilizados pela PDO para blindar a Query.
     */
    public function ExeRead($Tabela, $Colunas = null, $Termos = null, $ParseString = null) {
        $this->ResetParams();
        $this->Termos = $Termos;
        $this->Tabela = (string) $Tabela;
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;
        if (!empty($Colunas)):
            $this->Colunas = (string) $Colunas;
            $this->Select = "SELECT {$this->Colunas} FROM {$this->Tabela} {$this->Termos}";
        else:
            $this->Select = "SELECT * FROM {$this->Tabela} {$this->Termos}";
            $this->Colunas = null;
        endif;
        $this->Connect();
        $this->Execute();
    }

    public function getResultado() {
        return $this->Resultado;
    }

    public function getRowCount() {
        return $this->Read->rowCount();
    }

    public function FullRead($Query, $ParseString = null) {
        $this->ResetParams();
        $this->Select = (string) $Query;
        if (!empty($ParseString)):
            parse_str($ParseString, $this->Places);
        endif;
        $this->Execute();
    }

    public function setPlaces($ParseString) {
        parse_str($ParseString, $this->Places);
        $this->Execute();
    }

    public function setColunas($Colunas) {
        $this->Colunas = (string) $Colunas;
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
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * Private funcrion getSyntax();
     * Prepara a QUERY para ser executada posteriormente pela funcão Execute();
     */
    private function getSyntax() {
        if (!empty($this->Colunas)):
            $this->Select = "SELECT * FROM {$this->Tabela} {$this->Termos}";
            $this->Select = str_replace('*', $this->Colunas, $this->Select);
            $this->Read = $this->Conn->prepare($this->Select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        endif;
        if ($this->Places):
            foreach ($this->Places as $Vinculo => $Valor):
                if ($Vinculo == 'limit' || $Vinculo == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Read->bindValue(":{$Vinculo}", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    /**
     * Private function Execute();
     * Chama a funcção Connect() para realizar a conexão com o banco de dados e executa
     * a QUERY preparada.
     * Retorna o ID do último registro inserido no banco.
     */
    private function Execute() {
        $this->Connect();
        try {
            $this->getSyntax();
            $this->Read->execute();
            $this->Resultado = $this->Read->fetchAll();
        } catch (PDOException $e) {
            $this->Resultado = null;
            WSErro("Erro ao ler dados: {$e->getMessage()}", $e->getCode());
        }
    }

    /**
     * Private function ResetParams();
     * Quando chamada seta todos os atributos da classe para null.
     * Garantindo assim que a Query seja executada livre parametros indesejados.
     */
    private function ResetParams() {
        $this->Select = null;
        $this->Tabela = null;
        $this->Colunas = null;
        $this->Termos = null;
        $this->Places = null;
        $this->Resultado = null;
    }

}
