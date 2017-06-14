<?php

//Configurações do Site ##############################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'agendaitapolis_testes');




//AUTOLOAD de Classes   ##############################
function __autoload($Class) {
    $cDir = array('Conn','Models','Helpers');
   // $cDir  = [];
    $iDir = null;
    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$Class}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php")):
            include_once(__DIR__ . "\\{$dirName}\\{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;
    if (!$iDir):
        trigger_error("Não foi possível incluír {$Class}.class.php", E_USER_ERROR);
        die();
    endif;
}

//Tratamento de Erros   ##############################
//CSS Constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSErro :: Exibe os Erros Lançados - Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "{$ErrMsg}";
    echo "<span style=\"ajax_close\"></span>";
    echo "</p>";
    if ($ErrDie):
        die();
    endif;
}

//PHPERRO :: Exibe os Erros Lançados - Front
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: {$ErrLine}</b> :: {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span style=\"ajax_close\"></span>";
    echo "</p>";
    if ($ErrNo == E_USER_ERROR):
        die();
    endif;
}

set_error_handler('PHPErro');
