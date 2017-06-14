<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
?>
<!DOCTYPE HTML>
<html lang="pt-BR" xmlns:og="http://opengraphprotocol.org/schema/">
<head>
		<meta charset="UTF-8">
		<title>Agenda Itápolis</title>
        <meta name="description" content="Acesse a Agenda Itápolis e tenha todos os telefones do comércio da cidade nas palmas de suas mãos, com 
        facilidade e agilidade."/>
        <meta name="keywords" content="lista itápolis, comércio itápolis, lojas itápolis, telefones de itápolis, lista online, agenda online"/>
        <meta name="robots" content="index, follow">
        <meta name="author" content="Thiago Henrique Previateri">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta  name = "mobile-web-app-capable"  content = "yes" > 
		<meta property="og:image" content="http://www.agendaitapolis.com.br/thumbnail.png"/>
        <link  rel="icon"  sizes="192x192" href="img/icon-touch-v1.png"/>
		<link  rel="icon"  sizes="128x128" href="img/icon-touch-v2.png"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<link rel="stylesheet" href="css/home.css"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript" src="script/home.js"></script>
		<script type="text/javascript" src="script/funcoes.js"></script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-56968741-3', 'auto');
          ga('send', 'pageview');
        </script>
		<script type="text/javascript">
			var novaVersao = "1.15.6.01_3";
			function carregaVersao(){
					if(localStorage.primeiravisita == "true"){
						if (localStorage.versao != novaVersao){
							if(confirm("Uma nova versão está disponível, deseja atualizar agora?")){
									localStorage.versao = novaVersao;
									location.href="http://m.agendaitapolis.com.br/";
							}
						}
					}else{
						localStorage.primeiravisita = "true";
						localStorage.versao = "1.15.5 - Atualização Disponível";
					}
			}
		carregaVersao();
		</script>
	</head>
<body>
	<div id="categoria" data-role="page">
		<div data-role="header">
			<h1>Agenda Itápolis</h1>
			<a href="#painelOpcoes" class="ui-btn-right"  data-role="button" data-iconpos="notext" data-theme="b" data-icon="gear"></a>
		</div>
		<div data-role="navbar">
					<ul>
						<li>
							<a href="#"  class="ui-btn-active ui-state-persist" data-theme="b" data-icon="grid">Ramo de Atividades</a>
						</li>
						<li>
							<a href="#oAlfabetica" data-transition="flip" data-theme="b" data-icon="bars">Ordem Alfabética</a>
						</li>	
					</ul>
		</div>
		<div data-role="content"> 
			<ul id="autocomplete2" data-autodividers="true" data-filter-reveal="false" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Ex: Sorveteria, Padaria, etc..."></ul>
			<a href="#"  id="btn_listarTodasCategorias" data-role="button" data-icon="arrow-d" data-iconpos="right" data-theme="b" data-mini="true">Listar</a>	
			<div id="todasCategorias" data-form="ui-block-a" data-theme="b" class="ui-body ui-body-a ui-corner-all">
				<ul id="ul_TodasCategorias" data-autodividers="true" data-role="listview" data-filter="true" data-filter-placeholder="Filtrar..." ></ul>
			</div>
			<div id="parceiro"  data-form="ui-body-a" data-theme="b" class="ui-body ui-body-a ui-corner-all">
				<div data-role="header" style="background:#22AADD;">
				<h1>Parceiros</h1>
			</div>
			<div style="background:#FFF;">
				<img  id="imgParceiro" src="img/parceiros/ajax-loader.gif" alt="Parceiros" style="margin:0px auto; margin-bottom:-0.2em;display:block;max-width:100%; max-height:40%"/>
			</div>
			<ul id="parceiros" data-role="listview" data-inset="true" style="text-align:center;"></ul>
			<div id="controles_parceiros" data-role="controlgroup" data-type="horizontal" data-theme="b" style="text-align:center">
				<a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-notext" id="fb_parceiro" target="_blank"></a>
				<a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-notext" id="local_parceiro" data-ajax="true" target="_top"></a>
				<a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-phone ui-btn-icon-notext" id="discar_parceiro"></a>
			</div>
			<div data-role="footer" style="background:#22AADD;"> 
				<h1 style="white-space: normal !important;">Os parceiros são empresas que apoiam o Agenda Itápolis</h1>
			</div>
			<a href="#" id="btnVerTodos" data-theme="b" data-role="button" data-mini="true" data-icon="arrow-d" data-iconpos="bottom">Ver Todos</a>
			<a href="#" id="btnVeja" data-theme="b" data-role="button" data-mini="true" style="display:none;"></a>
			</div>
			<ul id="listaCategoria" data-autodividers="true" data-role="listview" data-inset="true"></ul>
			<div id="tagsEncontradas" data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
				<div data-role="header" data-theme="b" style="background:#2AD;">
					<h1 style="white-space:normal !important;">Tags</h1>
				</div>	
				<p>Encontramos as opções abaixo relacionadas a sua pesquisa!</p>
				<div >
					<a href="#" id="btnTagsEncontradas"  data-role="button" data-mini="true" data-theme="b" ></a>
				</div>
			</div>
			<div id="nenhumResultado2"  data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
				<div data-role="header" data-theme="b" style="background:#2AD;">
					<h1 style="white-space:normal !important;">Nenhum resultado!</h1>
				</div>
				<p>Sua empresa deveria aparecer aqui? <br />Entre em contato e nos informe. <br />O cadastro é GRATUITO.</p>
				<a href="#contato"  data-role="button" data-mini="true" data-transition="slidedown" data-theme="b" data-icon="mail" data-iconpos="bottom">CONTATO</a>
			</div>
		</div>
		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a href="#sobre" data-mini="true" data-shadow="false" data-role="button" data-transition="slideup" data-corners="false" data-theme="b" >Sobre</a></li>
				</ul>
			</div>
		</div>
		<div data-role="panel" id="painelOpcoes" data-display="overlay" data-position="right" data-theme="b" data-position-fixed="false">
			<h3>Opções</h3>
			<p>Utilize as opções abaixo para limpar os dados armazenados ou atualizar o aplicativo.</p>
			<fieldset data-role="fieldcontain">
				<label for="btn_limpar">Limpar Favoritos</label>
				<button id="btn_limpar" data-role="button" data-mini="true" data-theme="b" data-icon="delete">Limpar</button>
				<label for="btn_atualizar">Atualizar Aplicativo</label>
				<button id="btn_atualizar" data-role="button" data-mini="true" data-theme="b" data-icon="refresh">Atualizar</button>
			</fieldset>
			<a id="btnDialog" href="#dialogPage" data-rel="dialog" data-transition="pop"></a>
			<div>	
				<a href="#" id="btnFechar" data-mini="true" data-role="button" data-theme="a" data-rel="close">FECHAR</a>
			</div>
		</div>	
	</div>
	<div id="oAlfabetica" data-role="page">
			<div id="favoritoAdicionado">
				<h2>Adicionado</h2>
			</div>
			<div id="favoritoRemovido">
				<h2>Removido</h2>
			</div>
			<div id="headerPrincipal" data-role="header"> 
				<h1 style="white-space:normal !important;">Agenda Itápolis</h1>
				<a href="#painelFavoritos" id="btnFavoritos" data-role="button" data-iconpos="notext" data-theme="b" data-icon="star"></a>
			</div>
			<div data-role="navbar">
				<ul>
					<li>
						<a href="#categoria" data-transition="flip" data-theme="b" data-icon="grid">Ramo de Atividades</a>
					</li>
					<li>
						<a href="#" class="ui-btn-active ui-state-persist" data-theme="b" data-icon="bars">Ordem Alfabética</a>
					</li>
				</ul>
			</div>
			<div data-role="content"> 
					<ul id="autocomplete" data-autodividers="true" data-split-icon="star" data-split-theme="b" data-split-icon="gear" data-split-theme="a" data-filter-text="true" data-filter-reveal="false" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Nome ou número..."></ul>	
					<div id="nenhumResultado"  data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
						<div data-role="header" data-theme="b" style="background:#2AD;">
									<h1 style="white-space:normal !important;">Nenhum resultado!</h1>
						</div>
						<p>Sua empresa deveria aparecer aqui? <br />Entre em contato e nos informe. <br />O cadastro é GRATUITO.</p>
						<a href="#contato"  data-role="button" data-mini="true"
						data-transition="slidedown" data-theme="b" data-icon="mail" data-iconpos="bottom">CONTATO</a>
					</div>
			</div>
			<div data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="#sobre" data-mini="true" data-shadow="false" data-role="button" data-transition="slideup" data-corners="false" data-theme="b" >Sobre</a></li>
					</ul>
				</div>
			</div>
			<div data-role="panel" id="painelFavoritos" data-display="overlay" data-theme="b" data-position-fixed="false">
					<h3>FAVORITOS</h3>
					<p>Arraste o número para a esquerda para adicioná-lo aos seus favoritos e arraste-o para a direita para removê-lo.</p>
					<ul id="ulFavoritos" data-role="listview" data-theme="a" data-autodividers="true" data-filter="true" data-filter-placeholder="Pesquise..."></ul>
					<div data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
						<p>Você ainda não possui nenhum favorito.</p>
					</div>
					<div>	
						<a href="#" id="btnFechar" data-mini="true" data-role="button" data-theme="a" data-rel="close">FECHAR</a>
					</div>
			</div>
	</div>
	<div id="contato" data-role="page" data-theme="b"> 
		<div data-role="header">
				<h1 data-icon="list">contato</h1>
		</div>
		<div data-role="content"> 
			<div id="enviadoOK"><h3>Email Enviado!</h3><h4>Obrigado!</h4></div>
			<div id="enviadoFalha"><h3>Houve algum problema e o seu contato não pode ser enviado...</h3><h4>Tente novamente!</h4></div>
			<div  data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
				<p style="text-align:center;">Preencha os campos abaixo... Informe seu nome, o nome da empresa que deseja adicionar na Agenda e o Telefone. Se tudo estiver correto o número logo será incluído... </p>
				<div style="max-width:512px; margin:0 auto;">
					<form id="formContato" action="php/envia_email.php" > 
						<div data-role="fieldcontain"> 
							<label for="formContatoNome" class="ui-hidden-accessible">Nome:</label>
							<div class="input">
								<input type="text" id="formContatoNome" placeholder="Seu nome..." autofocus required/>
							</div>
						</div>
						<div data-role="fieldcontain">
							<label for="formContatoNome" class="ui-hidden-accessible">Nome do comércio:</label>
							<div class="input">
									<input type="text" id="formContatoMensagem" placeholder="Nome e ramo do seu comércio..." value="" required />
							</div>
						</div>
						<div data-role="fieldcontain"> 	
							<label for="formContatoTelefone" class="ui-hidden-accessible">Telefone:</label>
							<div class="input">
									<input type="tel" id="formContatoTelefone" placeholder="Telefone..." required />
							</div>	
						</div>
						<input  type="button" id="btnEnviaContato" data-role="button" data-theme="b" data-icon="action" data-iconpos="top" value="Enviar"/>
					</form>
				</div>
			</div>
		</div>
		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a href="agenda.php" data-role="button"  data-ajax="true" data-transition="slidedown">Fechar</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="sobre" data-role="page"  data-theme="b">
			<header data-role="header">
				<h1>sobre</h1>
			</header>
			<div data-role="content">
				<div data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all">
							<h3><strong>Agenda Itápolis - <?= date('Y') ?></strong><br /><div id="ver" style="font-size:0.5em"></div></h3>
								<p>O <strong>Agenda Itápolis</strong> surgiu com o objetivo de proporcionar
                                aos seus usuários a facilidade e agilidade na hora de buscar pelos números de telefone do comércio local.
                                Possui uma interface simples e intuitiva, desenvolvido
                                em duas versões sendo esta para SmartPhones, o aplicativo trabalha em conjunto
                                com os navegadores padrões dos dispositivos, oferecendo ao usuário a sensação de se estar utilizando um aplicativo nativo
                                de seu SmartPhone.
                            </p>        
							<div id="webmaster">
								<header data-role="header" data-theme="b">
									<h1>Contatos</h1>
								</header>
								<p><span>Agenda Itápolis</span></p>
								<a href="mailto:contato@agendaitapolis.com.br" data-ajax="false" target="_blank">contato@agendaitapolis.com.br</a>
								<p>Entre em contato conosco e envie sua dúvida, crítica, sugestão ou elogio. Você também pode nos enviar alguma correção em relação aos números na agenda 
                                ou se tornar nosso parceiro e ter sua empresa em <strong>DESTAQUE</strong>. Ficaremos felizes em lhe atender!</p>
								<p><strong>Fernando Previateri - Representante Comercial</strong>
								<br /><a href="tel:997424415">(16)99742-4415</a><br /> 
								[Chame pelo WhatsApp]</p>
								<div class="ui-grid-a">
									<div class="ui-block-a"><a href="fb://page/690882757675007" data-theme="b" data-iconpos="top" data-role="button" data-mini="true" data-icon="user">Facebook</a></div>
									<div class="ui-block-b"><a href="tel:991951876" data-iconpos="top" data-theme="b" data-role="button" data-mini="true" data-icon="phone">Celular</a></div>
								</div>
							</div>
				</div>
			</div>
			<footer data-role="footer" data-position="fixed">
				<div data-role="navbar">
					<ul>
						<li><a href="#" data-role="button" data-rel="back">Fechar</a></li>
					</ul>
				</div>
			</footer>
		</div>		
	<div id="dialogPage" data-role="page"  data-close-btn="none">
		<div data-role="header">
			<a href="#" data-role="button" data-iconpos="notext" data-theme="b" data-icon="alert"></a>
			<h2>Atenção</h2>
		</div>
		<div role="main" class="ui-content" style="background:#22AADD !important; text-shadow:none;" >
			<p>Essa ação não pode ser desfeita. Deseja mesmo continuar?</p>
			<a href="#" id="btn_limparConfirma" data-role="button" data-mini="true">Sim</a>
			<a href="#" data-role="button" data-rel="back" data-mini="true" data-theme="b">Não</a>
		</div>
	</div>
	<div id="descreveVersao" data-role="page" style="font-size:0.7em !important" data-theme="b">
			<div data-role="header">
				<h1>versões do aplicativo</h1>
			</div>
			<div data-role="content">
				<div data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all" >
					<h3>Versão 1.15.5.xx_x</h3>
					<p>Disponibilizada durante maio/junho - 2015</p>
					<ul>
						<li>Destaque de parceiros na busca alfabética.</li>
						<li>Melhorias no layout.</li>
						<li>Busca através de palavras chaves.</li>
						<li>Correção de falhas e bugs em dispositivos iOS.</li>
					</ul>
					<h3>Versão 1.15.4.xx_x</h3>
					<p>Disponibilizada durante abril - 2015</p>
					<ul>
						<li>Armazenamento em cache, avisando sobre status da conexao do dispositivo.</li>
						<li>Permite que o usuário utilize o aplicativo com o disposito apenas na vertical.</li>
						<li>Melhorias no layout.</li>
						<li>Correção de bugs.</li>
					</ul>
				</div>
			</div>	
		</div>
	<div id="pgGirar" data-role="page">
			<div class="content" id="pgGirarContent">
				<h1>Para continuar <span>GIRE</span> seu dispositivo.</h1>
				<a id="pgGirar_btn1" href="#"> <img src="img/icon-girar.png" alt="Icon  Girar - Agenda Itápolis" /></a>
			</div>	
		</div>
</body>
</html>
<?php
}else{
	if(preg_match('/MSIE/i',$useragent) && !preg_match('/Opera/i',$useragent)){ 
       header('Location: http://www.agendaitapolis.com.br/index.php');
    } 
    elseif(preg_match('/Trident\/7.0; rv:11.0/',$useragent)){
		header('Location: http://www.agendaitapolis.com.br/index.php');
	}
	elseif(preg_match('/Firefox/i',$useragent)){ 
        header('Location: http://www.agendaitapolis.com.br/index.php');
    } 
	elseif(preg_match('?rv:([0-9\.]+)?', $useragent)){
		header('Location: http://www.agendaitapolis.com.br/index.php');
	}else{
        header('Location: http://www.agendaitapolis.com.br/index.php');
	}
}		
?>