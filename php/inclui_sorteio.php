<?php
	setlocale(LC_TIME, "pt_BR.utf8");
    date_default_timezone_set('America/Sao_Paulo');
    include('funcoes.php');
	conectaBanco();
	$nome = $_GET['nome'];
	$empresa = $_GET['empresa'];
	$email = $_GET['email'];
	
	$nome = formataNome($nome);
	$empresa = formataNome($empresa);
	$email = strtolower(formataNome($email));
	
	$sql = "INSERT INTO participantesSORTEIO(ps_nome, ps_empresa, ps_email) VALUES ('".$nome."','".$empresa."','".$email."')";
    mysql_query($sql);
	unset($sql);
	desconectaBanco();
?>

<?php	
	header("Location: http://agendaitapolis.com.br/um-ano-do-agenda/#obrigado");
?>
