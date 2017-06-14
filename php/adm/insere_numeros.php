<?php 
	include('../funcoes.php');
	conectaBanco();
	$result = mysql_query("INSERT INTO agenda_comercial(nome, telefone, categoria) VALUES ('" . $_POST["Nome"]."', '" .$_POST["Telefone"]. "', '".$_POST["Categoria"]."');");
	$result = mysql_query("SELECT id AS 'Id', nome AS 'Nome', telefone AS 'Telefone', categoria AS 'Categoria' FROM agenda_comercial WHERE id = LAST_INSERT_ID();");
	$row = mysql_fetch_array($result);
	desconectaBanco();
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['Record'] = $row;
	print json_encode($jTableResult);
?>	