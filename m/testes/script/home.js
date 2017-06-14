var frases = [
	"Rastreando estrelas...", 
	"Pintando a lua...",
	"Enchendo balões...",
	"Retomando o fôlego...",
	"Comendo uma pizza...",
	"Folheando listas...",
	"Reunindo amigos...",
	"Kame..Hame...",
	"Aguarde...",
	"Carregando...",
	"Roda a roda...",
	"Foi sem querer...",
	"Não fui eu...",
	"Separando legos...",
	"Pintando tudo de azul...",
	"Mapeando telefones...",
	"Você acredita nisso?"];
var sugestao = Math.ceil(Math.random() * frases.length);
var db;
var shortName = 'projetoAgenda';
var version = '1.0';
var displayName = 'Agenda Comercial';
var maxSize = 65536;
var versao = localStorage.versao;
var pCategoria ="";
$.mobile.loading( "option", {
	text: "Aguarde...",
	textVisible: true,
	theme: "b",
	html: ""
});


$(window).on( "orientationchange", function(orientation) {
	getOrientation(orientation);
});

$(document).on("pageinit","#categoria",function(){
	var $enviar = 0;
	hideElements();
	$('#btn_atualizar').on("tap",function(){
        $('div.ui-loader h1').text(embaralhaFrases());
		$('div.ui-loader').css("display","block");
        location.reload();
    });
    $('#btn_limpar').on("tap",function(){
		$('#btnDialog').click();
		$('#btn_limparConfirma').on("tap",function(){
					$('#dialogPage').dialog("close");	
					limpaFavoritos();
			});
	});
	$('input:first').on("focus",function(){
		$('#todasCategorias').hide();
	});
	$("#autocomplete2").on("listviewbeforefilter",function (e,data){
		statusConexao();
		$('div.ui-loader').css("display","none");
		$('#tagsEncontradas').hide();
		$('#btnVeja').hide();
		$('#listaCategoria').hide();
		$('#todasCategorias').hide();
		$('#nenhumResultado2').hide();
        $('#parceiro').hide();
		$('#imgParceiro').attr("src","img/parceiros/ajax-loader.gif");
		$input = $( data.input );
		value = $input.val();
		if(value && value.length > 3){
			$('div.ui-loader h1').text(embaralhaFrases());
			$('div.ui-loader').css("display","block");
			$('#listaCategoria').listview("refresh");
			listaRamoAtividades(value);
		};
	});
	$('#btn_listarTodasCategorias').on("tap", function(){
	$('#nenhumResultado2, #parceiro, #listaCategoria, #tagsEncontradas').hide();
	$('input:first').val("");	
	var $ul = $('#ul_TodasCategorias');
	if($enviar == 0){
		$('div.ui-loader h1').text(embaralhaFrases());
		$('div.ui-loader').css("display","block");
		var html = "";
		$.getJSON('php/lista_todas_categorias.php',
			{
				busca: "teste"
			},
			function(data){
				if(data!=null){
				$.each(data, function(i,obj){
					var nomeCategoria = obj.Categoria;
					html += "<li><a href='#' >"+nomeCategoria+"</a></li>";
				});	
					$enviar = 1;
				}else{
					html += "<li>Nenhum Resultado</li>";
				}	
				$('div.ui-loader').css("display","none");
				$ul.html(html);
				$ul.listview("refresh");
				$ul.trigger("updatelayout");
				$('li.ui-li-divider').css('background','#22AADD');
				 $('li.ui-li-divider').css('font-size','1em');
				$('#todasCategorias').slideDown();
				$('#ul_TodasCategorias li a').on("tap",function(){
					var value = $(this).text();
					$('#todasCategorias').hide();
					$('#categoria div .ui-input-search input').attr("value",value);
					$('#categoria div .ui-input-search input').val(value);
					listaRamoAtividades(value);
				});
			}			
		);
	}else{
			$("#todasCategorias").toggle();
		}	
	});	
	$('#btnVerTodos, #btnVeja, #btnTagsEncontradas').on("tap", function(){
		statusConexao();
		$('#listaCategoria').slideDown('fast');
		$('#parceiro').slideUp('');
		$('div.ui-loader h1').text(embaralhaFrases());
		$('div.ui-loader').css("display","block");
		var $ul = $('#listaCategoria');
		var $parceiros = $('#parceiros');
        var tel_parceiro = "";
		value = pCategoria;
		//value = $('input').val();
		html = "";
		$parceiros.html("");
		$ul.html("");
		$('#nenhumResultado2').hide();
		$('#parceiro').hide();
		$('#tagsEncontradas').hide();
		$.getJSON('php/lista_fones_categoria.php',
			{
			 busca: value
			},
				function(data){
					if(data!=null){
						$.each(data, function(i,obj){
							var parceria = obj.Parceria;
							var nome = obj.Nome;
                            var numTel = obj.Telefone;
							var idTel =  obj.Id;
                            var categoria =obj.Categoria;
							html += "<li><a id='"+idTel+"'class='ui-icon-phone' href=tel:"+numTel+"><h2>"+nome+"</h2'>";
							html += "<div id='divCategoria'><strong>["+categoria+"]</strong></div>";
                            html += "<h3>(16)"+numTel+"</h3></a>";
							if(parceria == "1"){
								var id = obj.Id;
								var localizacao = obj.localizacao;
								var endereco = obj.endereco;
								var facebook = obj.facebook;
								var caminhoImagem = obj.caminhoImagem;
								var htmlParceiros = "";
								html += "<a href='#parceiros"+id+"' data-theme='b' data-transaction='pop' data-icon='star' style='background:#000 !important'></a></li>";
								htmlParceiros += "<div data-role='page' id='parceiros"+id+"' class='pgParceiros'>";
								htmlParceiros  += "<div data-role='header' data-theme='b'><h3>Parceiros</h3>";
								htmlParceiros += "<a href='#' data-rel='back'  class='ui-btn ui-shadow ui-corner-all ui-icon-arrow-l ui-btn-icon-notext'></a></div>";
								htmlParceiros += "<div data-form='ui-body-a' data-theme='b' class='ui-body ui-body-a ui-corner-all'>";
								htmlParceiros += "<div style='background:#FFF;'><img  src='img/parceiros/"+caminhoImagem+"'style='margin:0pxauto;margin-bottom:-0.2em;display:block;max-width:100%; max-height:40%'/></div>";
								htmlParceiros += "<ul data-role='listview'><li><a id='"+idTel+"'class='ui-btn ui-btn-no-icon' href=tel:"+numTel+"><h2>"+nome+"</h2'>";
								htmlParceiros += "<div id='divCategoria'><strong>["+categoria+"]</strong></div>";
								htmlParceiros += "<h3>(16)"+numTel+"</h3></a></li></ul>";
								htmlParceiros += "<div id='controles_parceiros' data-role='controlgroup' data-type='horizontal' data-theme='b' style='text-align:center'>";
								htmlParceiros += "<a href='fb://page/"+facebook+"' class='ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-notext'  target='_blank'></a>";
								htmlParceiros += "<a href='mapa.php?local="+localizacao+"&parceiro="+obj.Nome+"&endereco="+endereco+"&telefone="+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-notext'  data-ajax='false'></a>";
								htmlParceiros += "<a href='tel:"+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-phone ui-btn-icon-notext'></a></div>";
								htmlParceiros += "<div data-role='footer' style='background:#22AADD;'><h1 style='white-space: normal !important;'>Os parceiros são empresas que apoiam o Agenda Itápolis</h1></div>";
								htmlParceiros += "</div>";
								htmlParceiros += "</div>";
								$('body').append(htmlParceiros);
							}
						});	
					}else{
						$('#nenhumResultado2').fadeIn();
					}	
					$('div.ui-loader').css("display","none");
					$ul.html(html);
					$ul.listview("refresh");
					$ul.trigger("updatelayout");
                    $('li.ui-li-divider').css('background','#22AADD');
					$('li.ui-li-divider').css('font-size','1em');
					$('#listaCategoria a:even').css('background','#E9E9E9');
				}			
			);	
	}); 
});
$(document).on("pageinit","#oAlfabetica",function(){
	hideElements();
	statusConexao();
	$('div.ui-loader').css("display","none");
	var parceiros = $('#popsParceiros');
	$('#btnFavoritos').tap(function(){
		console.log("Listar favoritos");
		listaFavoritos();
	});
	$("#autocomplete").on("listviewbeforefilter", function (e,data){
		$('div.ui-loader').css("display","none");
		var $ul = $( this ),
		$input = $( data.input ),
		value = $input.val(),
		html = "";
		$ul.html("");
		$('div').remove('.pgParceiros');
		$('#nenhumResultado').hide();
		if(value && value.length > 3){
			$('div.ui-loader h1').text(embaralhaFrases());
			$('div.ui-loader').css("display","block");
			$ul.listview( "refresh" );
			$.getJSON('php/lista_fones.php',
				{
					chave: "OA",
					busca: $input.val()
				},
				function(data){
					if(data!=null){
						$.each(data, function(i,obj){
							var parceria = obj.Parceria;
							var nome = obj.Nome;
                            var numTel = obj.Telefone;
							var idTel =  obj.Id;
                            var categoria =obj.Categoria;
							html += "<li><a id='"+idTel+"'class='ui-icon-phone' href=tel:"+numTel+"><h2>"+nome+"</h2'>";
							html += "<div id='divCategoria'><strong>["+categoria+"]</strong></div>";
                            html += "<h3>(16)"+numTel+"</h3></a>";
							if(parceria == "1"){
								var id = obj.Id;
								var localizacao = obj.localizacao;
								var endereco = obj.endereco;
								var facebook = obj.facebook;
								var caminhoImagem = obj.caminhoImagem;
								var htmlParceiros = "";
								html += "<a href='#parceiros"+id+"' data-theme='b' data-transaction='pop' style='background:#000 !important'></a></li>";
								htmlParceiros += "<div data-role='page' id='parceiros"+id+"' class='pgParceiros'>";
								htmlParceiros  += "<div data-role='header' data-theme='b'><h3>Parceiros</h3>";
								htmlParceiros += "<a href='#' data-rel='back'  class='ui-btn ui-shadow ui-corner-all ui-icon-arrow-l ui-btn-icon-notext'></a></div>";
								htmlParceiros += "<div data-form='ui-body-a' data-theme='b' class='ui-body ui-body-a ui-corner-all'>";
								htmlParceiros += "<div style='background:#FFF;'><img  src='img/parceiros/"+caminhoImagem+"'style='margin:0pxauto;margin-bottom:-0.2em;display:block;max-width:100%; max-height:40%'/></div>";
								htmlParceiros += "<ul data-role='listview'><li><a id='"+idTel+"'class='ui-btn ui-btn-no-icon' href=tel:"+numTel+"><h2>"+nome+"</h2'>";
								htmlParceiros += "<div id='divCategoria'><strong>["+categoria+"]</strong></div>";
								htmlParceiros += "<h3>(16)"+numTel+"</h3></a></li></ul>";
								htmlParceiros += "<div id='controles_parceiros' data-role='controlgroup' data-type='horizontal' data-theme='b' style='text-align:center'>";
								htmlParceiros += "<a href='fb://page/"+facebook+"' class='ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-notext'  target='_blank'></a>";
								htmlParceiros += "<a href='mapa.php?local="+localizacao+"&parceiro="+obj.Nome+"&endereco="+endereco+"&telefone="+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-notext'  data-ajax='false'></a>";
								htmlParceiros += "<a href='tel:"+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-phone ui-btn-icon-notext'></a></div>";
								htmlParceiros += "<div data-role='footer' style='background:#22AADD;'><h1 style='white-space: normal !important;'>Os parceiros são empresas que apoiam o Agenda Itápolis</h1></div>";
								htmlParceiros += "</div>";
								htmlParceiros += "</div>";
								$('body').append(htmlParceiros);
							}
						});	
					}else{
						$('#nenhumResultado').fadeIn();
					}	
					$('div.ui-loader').css("display","none");
					$ul.html(html);
					$ul.trigger("updatelayout");
                    $ul.listview("refresh");
                    $('li.ui-screen-hidden').removeClass('ui-screen-hidden');
					$('li.ui-li-divider').css('background','#22AADD');
					$('#autocomplete a:even').css('background','#E9E9E9');
					$('#autocomplete a').on("swipeleft", function(e){
						var link = $(this).attr("href");
						var html = $(this).html();
						var id = $(this).attr("id");
                        $(this).on("vmouseup",function(e){
							insereFavoritos(id,html,link);	
						});
					});
				}					
			);
		};
	});
		
});
$(document).on("pageinit","#contato",function(){	
	$('#enviadoOK, #enviadoFalha').hide();
	
	$('#formContatoNome').on("tap",function(){
		$('#enviadoOK, #enviadoFalha').slideUp('fast');
	});
	
	$('#btnEnviaContato').on("tap",function(){
		statusConexao();
		$('div.ui-loader h1').text(embaralhaFrases());
		$('div.ui-loader').css("display","block");
		nome = $('#formContatoNome').val();
		mensagem = $('#formContatoMensagem').val();
		telefone = $('#formContatoTelefone').val();
		$.ajax({
			type: "POST",
			url: "php/envia_email.php",
			data: "nome="+nome+"&mensagem="+mensagem+"&telefone="+telefone,
			success: function(html){
				html = jQuery.trim(html);
				if(html == "true"){
					$('#enviadoFalha').hide();
					$('div.ui-loader').css("display","none");
					$('#enviadoOK').slideDown('slow');
					$('#formContato').each (function(){
						this.reset();
					});
				}
				else{
					$('div.ui-loader').css("display","none");
					$('#enviadoOK').hide();
					$('#enviadoFalha').slideDown('slow');	
				}
			}
		});
	});
});
$(document).on("pageinit","#sobre", function(){
	if(localStorage.versao){
		$('#ver').html("Versão: <a href='#descreveVersao'>"+versao+"</a>");
	}
});