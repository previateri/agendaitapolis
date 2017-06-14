<?php 
include('../funcoes.php');
	conectaBanco();
	$result = mysql_query("UPDATE agenda_comercial SET nome = '" . $_POST["Nome"] . "', telefone1 = '" . $_POST["Telefone"] . "', categoria = '" . $_POST["Categoria"] . "' WHERE id = " . $_POST["Id"] . ";");
	desconectaBanco();
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	print json_encode($jTableResult);
?>	