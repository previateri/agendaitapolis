<?php 
	include('../funcoes.php');
	conectaBanco();
    @$usuario = addslashes(trim($_POST['usuario']));
    @$senha = addslashes(trim($_POST['senha']));
    $senha = md5($senha);
	
	$query = "SELECT * FROM `usuarios` WHERE `nome` = '$usuario' AND `pass` = '$senha'";
	$res = mysql_query($query);
	desconectaBanco();
	
	$num_row = mysql_num_rows($res);
	$row = mysql_fetch_assoc($res);
	if($num_row == 1){
		$_SESSION["autenticado"] = true;
		echo "true";
	}else{
		echo "false";
	}	
?>