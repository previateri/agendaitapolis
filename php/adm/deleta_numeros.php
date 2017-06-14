<?php 
	include('../funcoes.php');
	conectaBanco();
	$result = mysql_query("DELETE FROM agenda_comercial WHERE id = " . $_POST["Id"] . ";");
	desconectaBanco();
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	print json_encode($jTableResult);
?>