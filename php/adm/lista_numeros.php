<?php 
	include('../funcoes.php');
	conectaBanco();
	$sql = "SELECT id AS 'Id', nome AS 'Nome', telefone AS 'Telefone', categoria AS 'Categoria'  FROM `agenda_comercial` ORDER BY nome";
	$result = mysql_query($sql);
	desconectaBanco();
	$rows = array();
	while($row = mysql_fetch_array($result)){
		$rows[] = $row;
	}
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['Records'] = $rows;
	print json_encode($jTableResult);
?>	