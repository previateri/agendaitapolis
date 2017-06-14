<?php 
	setlocale(LC_TIME, "pt_BR.utf8");
    date_default_timezone_set('America/Sao_Paulo');
    include('funcoes.php');
	conectaBanco();
  
    $sql = "SELECT DISTINCT categoria as 'Categoria' FROM `agnit_telefones` WHERE categoria NOT LIKE '%anuncio' ORDER BY categoria";
	$result = mysql_query($sql); 
    desconectaBanco();
    while($row = mysql_fetch_array($result)){
		$rows[] = $row;
	}
	$jTableResult = array();
	$jTableResult = $rows;
	print json_encode($jTableResult);
?>