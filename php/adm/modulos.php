<?php 
	 session_start();
	 if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != true){
		header("Location: ../../adm/index.php");
		
	}else{
		if(!isset($_POST["sairSistema"]) || $_POST["sairSistema"] != true){
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="../../script/jtable.2.4.0/themes/metro/blue/jtable.min.css"/>
	<style type="text/css"> 
		body{
			margin: 0 auto;
			padding: 0 auto;
			background:
			linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
			linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
			linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
			linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
			linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
			linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
			background-color: #131313;
			background-size: 20px 20px;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
	<script src="../../script/jtable.2.4.0/jquery.jtable.min.js"></script>
	<script src="../../script/jtable.2.4.0/localization/jquery.jtable.pt-BR.js"></script>
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('#modulos').tabs();
			$('#todosTelefones').jtable({
						title:'Telefones Cadastrados na Agenda',
						actions:{
							listAction: 'lista_numeros.php',
							createAction: 'insere_numeros.php',
							updateAction: 'altera_numeros.php',
							deleteAction: 'deleta_numeros.php'
						},
						fields:{
							Id:{
								title: 'ID',
								key:   true,
							},
							Nome:{
								title: 'Nome',
								width: '35%'
							},
							Telefone:{
								title: 'Telefone',
								width: '30%'
							},
							Categoria:{
								title: 'Categoria',
								width:'35%'
							}	
						}		
					});
			$('#todosTelefones').jtable('load');
			
			$('#btnSair').button().click(function(){
				var sair = true;
				$.ajax({
				   type: "POST",
				   url: "modulos.php",
				   data: "sairSistema="+sair,
				   success: function(html){
					html = jQuery.trim(html);
					if(html == "true"){
						//LOGIN DEU CERTO
						location.reload();
					}
					else{//LOGIN DEU ERRADO
						location.reload();
					}
				   }
				});
			});
			
		});	
	</script>
</head>
<body>
		<div id="header" style="background:snow;"> 
			<h2>Controle de telefones cadastrados na agenda</h2>
			<button  id="btnSair" type="button" >Sair</button>
		
		</div>
	
	<div id="modulos">
		<ul>
			<li><a href="#md1">Todos os números</a></li>
			<li><a href="#md2">Por Categoria</a></li>
			<li><a href="#md3">Lista de usuários</a></li>
		</ul>
		
		<div id="md1"> 
			<h3>Todos</h3>
			<div id="todosTelefones"></div>
		</div>
		
		<div id="md3"> 
			<h3>Usuários do Sistema</h3>
			<div id="Usuarios"></div>
		</div>
		
		
	</div>
	
	
	
	
</body>
</html>
<?php
	}else{
		session_destroy();
		print "true";
	}
}	
?>