<?php 
	include('funcoes.php');
	conectaBanco();
	$busca = $_GET['busca'];
	$busca = formataNome($busca);
    
	//Insere a busca no banco, caso maior que 5
	if(strlen($busca)>5){
           $sql = "INSERT INTO agnit_buscas_feitas(bf_termos, bf_time, bf_tela, bf_dispositivo) VALUES ('".$busca."', CURRENT_TIMESTAMP(),'RA','PC')";
        mysql_query($sql);
        unset($sql);
    }
    
	//FUNCÃO QUE BUSCA PELAS TAGS, CASO ENCONTRE, AS BUSCAS TERMINAM
	function buscaTags($busca){
		$busca_s = explode(" ",$busca);
		$numLinhas = 0;
		while($numLinhas <= 0){
			for ($i=0;$i < count($busca_s); $i++ ){
				if (($busca_s[$i] == "de") || ($busca_s[$i] == "da") || ($busca_s[$i] == "do") || ($busca_s[$i] == "das") || ($busca_s[$i] == "dos") || (strlen($busca_s[$i]) < 3)){
					$busca_s[$i] = null;
				}else{
					$busca = $busca_s[$i];
					$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria', parceiro as 'Parceria', parceiro_exibido as 'Exibido', localizacao, facebook, endereco, caminhoImagem, tags FROM `agnit_telefones` WHERE tags LIKE '%$busca%' AND parceiro = 1 ORDER BY nome";
					$result =  mysql_query($sql);
					$num_rows = mysql_num_rows($result);
					if($num_rows > 0){
						desconectaBanco();
						while($row = mysql_fetch_array($result)){
							$rows[] = $row;
							$jTableResult = array();
							$jTableResult = $rows;
							print json_encode($jTableResult);
							$numLinhas = 1;
							die;
						}
					}else{
							$sql = "SELECT `categoria` as 'Categoria', `tags` FROM `agnit_telefones` WHERE tags LIKE '%$busca%' ORDER BY `categoria`";
							$result =  mysql_query($sql);
							$num_rows = mysql_num_rows($result);
							if($num_rows > 0){
							desconectaBanco();
							while($row = mysql_fetch_array($result)){
								$rows[] = $row;
								$jTableResult = array();
								$jTableResult = $rows;
								print json_encode($jTableResult);
								$numLinhas = 1;
								die;
							}
						}	
					}
				}
			}
		$numLinhas = 1;
		};
		return $busca;
	}
	

	//Funcão que faz a busca quando há parceiros
	function busca_parceiros($busca){
		global $categoria;
		global $rows;
		$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria', parceiro as 'Parceria', parceiro_exibido as 'Exibido', localizacao, facebook, endereco, caminhoImagem FROM `agnit_telefones` WHERE categoria LIKE '%$busca%' AND parceiro = 1 ORDER BY nome";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)){
			//echo "Nome: ".$row['Nome']." -- Parceria: ".$row['Parceria']." -- Exibido: ".$row['Exibido']."<br />";
			$categoria = $row['Categoria'];
			if($row['Exibido'] === "0"){
				$rows[] = $row;
			}
		}
	}
	
	
	//Busca pelas tags - ANTIGA [DESATIVADA]{
	/*	
		$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria', parceiro as 'Parceria', parceiro_exibido as 'Exibido', localizacao, facebook, endereco, caminhoImagem, tags FROM `agnit_telefones` WHERE tags LIKE '%$busca%' AND parceiro = 1 ORDER BY nome";
		$result =  mysql_query($sql);
		$num_rows = mysql_num_rows($result);
		unset ($sql);
		if($num_rows > 0){
				while($row = mysql_fetch_array($result)){
					$rows[] = $row;
					$jTableResult = array();
					$jTableResult = $rows;
				print json_encode($jTableResult);
				die;
				}
			}else{
				//AS OUTRAS BUSCAS IAM AQUI
			}	
	}*/
	
	
	//Tenta a busca pelas tags
	$busca = buscaTags($busca);
	
	//Verifica se há parceiros relacionado a busca, para definir o tipo de busca a executar
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
	
	//Quando há parceiros relacionados a busca, procura-se pelos que ainda não foram exibidos	
	if($check === "true"){
		busca_parceiros($busca);
		//Caso todos os parceiros já tenham sido exibidos, envia o anuncio e reseta parceiros
		if($rows === null){
				$sql = "UPDATE `agnit_telefones` SET  `parceiro_exibido`= 0 WHERE  `parceiro` = 1 AND `categoria` =  '$categoria'";
				mysql_query($sql);
				unset($sql);
				$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria', parceiro as 'Parceria', parceiro_exibido as 'Exibido', localizacao, facebook, endereco, caminhoImagem FROM `agnit_telefones` WHERE id = 1019";
				$result = mysql_query($sql);
				unset($sql);
				while($row = mysql_fetch_array($result)){
					$rows[] = $row;
				}
				$jTableResult = array();
				$jTableResult = $rows;
				print json_encode($jTableResult);
				die;
		}else{
			//Envia o proximo parceiro a ser exibido e atualiza sua exibição
			$parceiro_exibido[] = array_shift($rows);
			if($num_rows > 1){
				$sql = "UPDATE `agnit_telefones` SET  `parceiro_exibido`= 1 WHERE  `id` =".$parceiro_exibido[0]['Id'];
			}
			mysql_query($sql);
			desconectaBanco();
			$jTableResult = array();
			$jTableResult = $parceiro_exibido;
			print json_encode($jTableResult);
			die;
		}
	}else{
		//Caso não haja parceiros, executa-se esta busca
		$sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Telefone', categoria as 'Categoria', parceiro as 'Parceria' FROM `agnit_telefones` WHERE categoria LIKE '%$busca%' ORDER BY nome";
		$result = mysql_query($sql);
		desconectaBanco();
		while($row = mysql_fetch_array($result)){
			$rows[] = $row;
		}
		$jTableResult = array();
		$jTableResult = $rows;
		print json_encode($jTableResult);
		die;
	}
?>

