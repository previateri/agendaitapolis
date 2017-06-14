<?php

/**
 * <b> Update.class [ CRUD - Básico ] </b>
 * Classe responsável pela atualização de dados em um banco.
 * [CR] UPDATE [D] - É a terceira de um grupo CRUD
 * Possui métodos para atualizar dados no banco de dados
 * 
 */
class Update extends Conn {

    private $Tabela;
    private $Dados;
    private $Termos;
    private $Places;
    private $Resultado;

    /** @var PDOStatement */
    private $Update;

    /** @var PDO */
    private $Conn;

    public function ExeUpdate($Tabela, array $Dados, $Termos, $ParseString) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->Termos = (string) $Termos;
        parse_str($ParseString, $this->Places);
        $this->getSyntax();
        $this->Execute();
    }

    public function getResultado() {
        return $this->Resultado;
    }

    public function getRowCount() {
        return $this->Update->rowCount();
    }

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
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Update = $this->Conn->prepare($this->Update);
    }

    private function getSyntax() {
        foreach ($this->Dados as $Key => $Value):
            $Places[] = $Key . ' = :' . $Key;
        endforeach;
        $Places = implode(', ', $Places);
        $this->Update = "UPDATE {$this->Tabela} SET {$Places} {$this->Termos}";
    }

    private function Execute() {
        $this->Connect();
        try {
            $this->Update->execute(array_merge($this->Dados, $this->Places));
            $this->Resultado = true;
        } catch (PDOException $e) {
            $this->Resultado = null;
            WSErro("Erro ao cadastrar: {$e->getMessage()}", $e->getCode());
        }
    }

}
