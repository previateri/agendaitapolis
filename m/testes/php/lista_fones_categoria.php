<?php 
	include('funcoes.php');
	conectaBanco();
	$busca = $_GET['busca'];
	$busca = formataNome($busca);
    if($busca){
            $sql = "INSERT INTO agnit_buscas_feitas(bf_termos, bf_time, bf_tela, bf_dispositivo) VALUES ('".$busca."', CURRENT_TIMESTAMP(),'LT','MO')";
        mysql_query($sql);
        unset($sql);
    }
    //Verifica se hรก parceiros relacionado a busca, para definir o tipo de busca a executar
	$check = "false";
	$sql = "SELECT id as 'Id', parceiro as 'Parceiro' FROM `agnit_telefones` WHERE categoria LIKE '%$busca%' AND parceiro = 1";
	$result =  mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	unset ($sql);
	while($row = mysql_fetch_array($result)){
		if($row['Parceiro'] == "1"){
				$check = "true";
			}	
	}

	if($check == "true"){
		$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria', parceiro as 'Parceria', localizacao, facebook, endereco, caminhoImagem FROM `agnit_telefones` WHERE categoria LIKE '%$busca%' ORDER BY nome";
	}else{
		$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria' FROM `agnit_telefones` WHERE categoria LIKE '%$busca%' ORDER BY nome";
	}
	
	$result = mysql_query($sql);
	desconectaBanco();
	while($row = mysql_fetch_array($result)){
		$rows[] = $row;
	}
	$jTableResult = array();
	$jTableResult = $rows;
	print json_encode($jTableResult);
?>