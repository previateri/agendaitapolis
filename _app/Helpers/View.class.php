<?php

/**
 * View.class [ HELPER MVS ]
 * Responsável por carregar o Template, povoar e exibir a view, povoar e incluir arquivos PHP no sistema.
 * Arquitetura MVC
 */
class View {
    private static $Data;
    private static $Keys;
    private static $Values;
    private static $Template;
    
    public static function Load($Template) {
        self::$Template = (string) $Template;
        self::$Template = file_get_contents(self::$Template . '.tpl.html');
    }
    
    public static function Show(array $Data) {
       self::setKeys($Data);
       self::setValues();
       self::showView();
    }
    
    public static function Request($File, array $Data) {
        extract($Data);
        require "{$File}.inc.php";
    }
    
    //Private
    
    private static function setKeys($Data) {
        self::$Data = $Data;
        self::$Keys =  explode('&','#' . implode('#&#',  array_keys(self::$Data)) . '#');
    }
    
    private static function setValues() {
        self::$Values = array_values(self::$Data);
    }
    
    private static function showView() {
        echo str_replace(self::$Keys, self::$Values, self::$Template);
    }
}
