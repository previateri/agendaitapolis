<?php

/**
 * <b> Create.class [ CRUD - Básico ] </b>
 * Classe responsável pela inserção de dados em um banco.
 * CREATE [RUD] - É a primeira de um grupo CRUD
 * Possui métodos para inserir dados separadamente [NOME DO MÉTODO] e em conjunto [NOME DO MÉTODO] 
 * 
 */
class Create extends Conn {

    private $Tabela;
    private $Dados;
    private $Resultado;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeCreate</b> : Executa um cadastro genérico no banco de dados utilizando prepares statements.
     * Informe:
     * @param STRING $Tabela = Nome da tabela no Banco.
     * @param ARRAY $Dados = Array contento os indices->(COLUNAS) e os dados->(VALUES).
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->getSyntax();
        $this->Execute();
    }

    /**
     * <b>ExeCreateMulti:</b> Executa um cadastro múltiplo no banco de dados utilizando prepared statements.
     * Basta informar o nome da tabela e um array multidimensional com nome da coluna e valores!
     * 
     * @param STRING $Tabela = Informe o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array multidimensional. ( [] = Key => Value ).
     */
    public function ExeCreateMulti($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = (array) $Dados;

        $Fields = implode(', ', array_keys($this->Dados[0]));
        $Places = null;
        $Inserts = null;
        $Links = count(array_keys($this->Dados[0]));

        foreach ($Dados as $ValueMult):
            $Places .= '(';
            $Places .= str_repeat('?,', $Links);
            $Places .= '),';

            foreach ($ValueMult as $ValueSingle):
                $Inserts[] = $ValueSingle;
            endforeach;
        endforeach;

        $Places = str_replace(',)', ')', $Places);
        $Places = substr($Places, 0, -1);
        $this->Dados = $Inserts;

        $this->Create = "INSERT INTO {$this->Tabela} ({$Fields}) VALUES {$Places}";
        $this->Execute();
    }

    public function getResultado() {
        return $this->Resultado;
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
        $this->Create = $this->Conn->prepare($this->Create);
    }

    /**
     * Private funcrion getSyntax();
     * Prepara a QUERY para ser executada posteriormente pela funcão Execute();
     */
    private function getSyntax() {
        $Fields = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fields}) VALUES ({$Places})";
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
            $this->Create->execute($this->Dados);
            $this->Resultado = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Resultado = null;
            WSErro("Erro ao cadastrar: {$e->getMessage()}", $e->getCode());
        }
    }
}
