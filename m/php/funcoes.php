<?php 
//FUNCOES

	//FORMATA NOMES
	function formataNome($nome){
		$nome = addslashes(trim(strtolower($nome)));
		$nome_s = explode(" ",$nome);
		for ($i=0;$i < count($nome_s); $i++ ){
			if (($nome_s[$i] == "de") || ($nome_s[$i] == "da") || ($nome_s[$i] == "do") || ($nome_s[$i] == "das") || ($nome_s[$i] == "dos")) {
				continue;
			}	else {
					$nome_s[$i] = ucfirst($nome_s[$i]);
				}
		}
		$nome = implode(" ",$nome_s);
		return $nome;	
	};
	
	
	//CONECTA AO BANCO DE DADOS
	function conectaBanco(){
		
	}
	
	//DESCONECTA DO BANCO DE DADOS
	function desconectaBanco(){
		mysql_close();
	}
	
	//INICIA SESSÃO
	function iniciaSessao($chave){
        session_start();
        $_SESSION["usuario"] = $codigo_usuario;
        $_SESSION["autenticado"] = TRUE;
        header("Location: atendimento.php");
    }
	
	//CHECA SESSÃO INICIADA
	function verificaSessao(){
		session_start;
		if(!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != TRUE){
			//CODIGO PARA ACESSO NÃO PERMITIDO
		}else {
			header("Location: atendimento.php");  
		} 
	}
	
	//TERMINA A SESSÃO
	function terminaSessao(){
		  session_start();
          session_destroy();
          header("Location: index.php");
          exit();
	}
	
	//CONVERTER A DATA PARA O BANCO DE DADOS
	function converteData($data)
	{
        if(validaData($data)) {
                return implode(!strstr($data, '/') ? "/" : "-", array_reverse(explode(!strstr($data, '/') ? "-" : "/", $data)));
        }       
	}
	
	//VALIDAR A DATA
	function validaData($data)
	{
        @$data = split("[-,/]",$data);
        if(!checkdate($data[1], $data[0], $data[2]) and !checkdate($data[1], $data[2], $data[0])) {
			return false;
        }else{ 
			return true;
		}
	}	
?>