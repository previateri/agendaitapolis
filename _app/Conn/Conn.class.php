<?php

/**
 * Conn.class [CONEXAO]
 * Descrição: Classe abstrata de conexão padrão SingleTon.
 * Retorna um objeto PDO pelo método estático getConn();
 */
class Conn {

    private static $Host = HOST;
    private static $Usser = USER;
    private static $Pass = PASS;
    private static $Dbsa = DBSA;

    /** @var PDO * */
    private static $Connect = null;

    /**
     * Conecta com o banco de dados utilizando o PATERN SingleTon.
     * Retorna um objeto PDO.
     */
    private static function Conectar() {
        try {
            if (self::$Connect == null):
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' ];
                self::$Connect = new PDO($dsn, self::$Usser, self::$Pass, $options);
            endif;
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die();
        }
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    /** Retorna um objeto PDO * */
    protected static function getConn() {
        return self::Conectar();
    }

}
