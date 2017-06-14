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

$.mobile.loading( "option", {
	text: "Aguarde...",
	textVisible: true,
	theme: "b",
	html: ""
});

function embaralhaFrases(){
	var sugestao = Math.ceil(Math.random() * frases.length);
	return frases[sugestao];
};	

function statusConexao(){
	var status = navigator.onLine;
	if(status == false){
		location.href="http://www.agendaitapolis.com.br/offline.html";
	}else{
		return true;
	}
};

function listaRamoAtividades(value){
		statusConexao();
		$('#btnVerTodos').show();
		$('div.ui-loader h1').text(embaralhaFrases());
		$('div.ui-loader').css("display","block");
		var $ul = $('#listaCategoria');
		var $parceiros = $('#parceiros');
		var tel_parceiro = "";
		html = "";
        $parceiros.html("");
		$ul.html("");
		$.getJSON('php/lista_fones_parceiros.php',
					{
					busca: value
					},
					function(data){
						if(data!=null){
							$.each(data, function(i,obj){
								 pCategoria = obj.Categoria;
								var parceria = obj.Parceria;
								var numTel = obj.Telefone;
								var idTel =  obj.Id;
								var tags = obj.tags;
								if(tags){
									if(!idTel){
										$('#tagsEncontradas').show();
										$('#btnTagsEncontradas').text(pCategoria);
									}else{
										$('#btnVerTodos').hide();
										$('#btnVeja').show().text("Tente: "+obj.Categoria);
									}
								}
								if(parceria == "1"){
									var localizacao = obj.localizacao;
									var endereco = obj.endereco;
									var facebook = obj.facebook;
									var caminhoImagem = obj.caminhoImagem;
									$('#imgParceiro').attr("src","img/parceiros/"+caminhoImagem);
									tel_parceiro += "<li><h2>"+obj.Nome+"</h2>";
									tel_parceiro += "<h3>(16)"+numTel+"</h3></li>";
									$parceiros.html(tel_parceiro);
									$('#fb_parceiro').attr("href","http://facebook.com/"+facebook);
									$('#local_parceiro').attr("href","mapa.php?local="+localizacao+"&parceiro="+obj.Nome+"&endereco="+endereco+"&telefone="+numTel);
									$('#discar_parceiro').attr("href","tel:"+numTel);
									$('#parceiro').show();
									$ul.hide()
								}else if(idTel){
									$ul.show();	
									html += "<li id='"+idTel+"'><span><h2>"+obj.Nome+"</h2'>";
									html += "<h3>(16)"+numTel+"</h3></a></li>";
								}
							});	
						}else{
							$('#nenhumResultado2').fadeIn();
						}	
						$('div.ui-loader').css("display","none");
						$ul.html(html);
						$parceiros.listview("refresh");
						$parceiros.trigger("updatelayout");
						$ul.listview("refresh");
						$ul.trigger("updatelayout");
						$('li.ui-li-divider').css('background','#22AADD');
						$('#listaCategoria a:even').css('background','#E9E9E9');
						$('#listaCategoria a').on("swipeleft", function(e){
							var link = $(this).attr("href");
							var html = $(this).html();
							var id = $(this).attr("id");
							$(this).on("vmouseup",function(e){
								$('#btnFechar').click();
								insereFavoritos(id,html,link);	
							});
						});	
					}			
		);
}

$(document).on("pageshow","#categoria",function(){
    $('input:first').focus();
});
$(document).on("pageshow","#home",function(){
  $("div.ui-input-search>input").focus();
});

$(document).on("pageinit","#home",function(){	
	statusConexao();
   $('div.ui-loader').css("display","none");
	$('#nenhumResultado').hide();
	$("#autocomplete").on("listviewbeforefilter", function (e,data){
		$('div.ui-loader').css("display","none");
		var $ul = $( this ),
		$input = $( data.input ),
		value = $input.val(),
		html = "";
		$ul.html("");
		$('#nenhumResultado').hide();
		$('div').remove('.pgParceiros');
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
							if(parceria == "1"){
								var id = obj.Id;
								var localizacao = obj.localizacao;
								var endereco = obj.endereco;
								var facebook = obj.facebook;
								var caminhoImagem = obj.caminhoImagem;
								var htmlParceiros = "";
								html += "<li id='"+idTel+"'><a href='#parceiros"+id+"'><span><h2>"+obj.Nome+"</h2'>";
								html += "<h3>(16)"+numTel+"</h3></a></span>";
								html += "<a href='#parceiros"+id+"' data-theme='b' data-transaction='pop' data-icon='star' style='background:#000 !important'></a></li>";
								htmlParceiros += "<div data-role='page' id='parceiros"+id+"' class='pgParceiros'>";
								htmlParceiros  += "<div data-role='header' data-theme='b'><h3>Parceiros</h3>";
								htmlParceiros += "<a href='#' data-rel='back'  class='ui-btn ui-shadow ui-corner-all ui-icon-arrow-l ui-btn-icon-notext'></a></div>";
								htmlParceiros += "<div data-form='ui-body-a' data-theme='b' class='ui-body ui-body-a ui-corner-all' style='max-width:768px'>";
								htmlParceiros += "<div style='background:#FFF;'><img  src='img/parceiros/"+caminhoImagem+"'style='margin:0 auto;margin-bottom:-0.2em;display:block;max-width:100%; max-height:40%'/></div>";
								htmlParceiros += "<ul data-role='listview'><li><h2>"+nome+"</h2'>";
								htmlParceiros += "<h3>(16)"+numTel+"</h3></li></ul>";
								htmlParceiros += "<div id='controles_parceiros' data-role='controlgroup' data-type='horizontal' data-theme='b' style='text-align:center'>";
								htmlParceiros += "<a href='http://facebook.com/"+facebook+"' class='ui-btn ui-shadow ui-corner-all ui-icon-user  ui-btn-icon-top'  target='_blank'>Facebook</a>";
								htmlParceiros += "<a href='mapa.php?local="+localizacao+"&parceiro="+obj.Nome+"&endereco="+endereco+"&telefone="+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-top' data-ajax='false'>Local</a>";
								htmlParceiros += "<a href='tel:"+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-phone ui-btn-icon-top'>Discar</a></div>";
								htmlParceiros += "<div data-role='footer' style='background:#22AADD;'><h1 style='white-space: normal !important;'>Os parceiros são empresas que apoiam o Agenda Itápolis</h1></div>";
								htmlParceiros += "</div>";
								htmlParceiros += "</div>";
								$('body').append(htmlParceiros);
							}else{
							html += "<li id='"+idTel+"'><span><h2>"+obj.Nome+"</h2'>";
                            html += "<p class='ui-li-aside'><strong>[- "+categoria+" -]</strong></p>";
							html += "<h3>(16)"+numTel+"</h3></span></li>";
							}
						});	
					}else{
						$('#nenhumResultado').fadeIn();
					}	
					$('div.ui-loader').css("display","none");
					$ul.html(html);
					$ul.listview("refresh");
					$ul.trigger("updatelayout");
                    $('li.ui-screen-hidden').removeClass('ui-screen-hidden');
                    $('li.ui-li-divider').css('background','#22AADD');
                    $('li.ui-li-divider').css('font-size','1em');
				}		
							
			);

		};
	});
	
});

$(document).on("pageinit","#categoria",function(){
	var $enviar = 0;
	$('input:eq(4)').focus();
    $('#nenhumResultado2').hide();
	$('#parceiro').hide();
	$('#todasCategorias').hide();   
	$('#tagsEncontradas').hide();
	
	$('#btn_listarTodasCategorias').on("tap", function(){
			statusConexao();
			$('#nenhumResultado2').hide();
			$('div.ui-loader').css("display","none");
			$('#parceiro').hide();
			$('#listaCategoria').hide();
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
				$('#todasCategorias').toggle();
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
							if(parceria == "1"){
								var id = obj.Id;
								var localizacao = obj.localizacao;
								var endereco = obj.endereco;
								var facebook = obj.facebook;
								var caminhoImagem = obj.caminhoImagem;
								var htmlParceiros = "";
								html += "<li id='"+idTel+"'><a href='#parceiros"+id+"'><span><h2>"+obj.Nome+"</h2'>";
								html += "<h3>(16)"+numTel+"</h3></a></span>";
								html += "<a href='#parceiros"+id+"' data-theme='b' data-transaction='pop' data-icon='star' style='background:#000 !important'></a></li>";
								htmlParceiros += "<div data-role='page' id='parceiros"+id+"' class='pgParceiros'>";
								htmlParceiros  += "<div data-role='header' data-theme='b'><h3>Parceiros</h3>";
								htmlParceiros += "<a href='#' data-rel='back' class='ui-btn ui-shadow ui-corner-all ui-icon-arrow-l ui-btn-icon-notext'></a></div>";
								htmlParceiros += "<div data-form='ui-body-a' data-theme='b' class='ui-body ui-body-a ui-corner-all' style='max-width:768px'>";
								htmlParceiros += "<div style='background:#FFF;'><img  src='img/parceiros/"+caminhoImagem+"'style='margin:0 auto;margin-bottom:-0.2em;display:block;max-width:100%; max-height:40%'/></div>";
								htmlParceiros += "<ul data-role='listview'><li><h2>"+nome+"</h2'>";
								htmlParceiros += "<h3>(16)"+numTel+"</h3></li></ul>";
								htmlParceiros += "<div id='controles_parceiros' data-role='controlgroup' data-type='horizontal' data-theme='b' style='text-align:center'>";
								htmlParceiros += "<a href='http://facebook.com/"+facebook+"' class='ui-btn ui-shadow ui-corner-all ui-icon-user  ui-btn-icon-top'  target='_blank'>Facebook</a>";
								htmlParceiros += "<a href='mapa.php?local="+localizacao+"&parceiro="+obj.Nome+"&endereco="+endereco+"&telefone="+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-top' data-ajax='false'>Local</a>";
								htmlParceiros += "<a href='tel:"+numTel+"' class='ui-btn ui-shadow ui-corner-all ui-icon-phone ui-btn-icon-top'>Discar</a></div>";
								htmlParceiros += "<div data-role='footer' style='background:#22AADD;'><h1 style='white-space: normal !important;'>Os parceiros são empresas que apoiam o Agenda Itápolis</h1></div>";
								htmlParceiros += "</div>";
								htmlParceiros += "</div>";
								$('body').append(htmlParceiros);
							}else{
							html += "<li id='"+idTel+"'><span><h2>"+obj.Nome+"</h2'>";
							html += "<h3>(16)"+numTel+"</h3></span></li>";
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
	
		
	$("#autocomplete2").on("listviewbeforefilter",function (e,data){
		statusConexao();
		$('div.ui-loader').css("display","none");
		$('#tagsEncontradas').hide();
		$('#listaCategoria').hide();
		$('#btnVeja').hide();
		$('#todasCategorias').hide();
		$('#imgParceiro').attr("src","img/parceiros/ajax-loader.gif");
		$('#nenhumResultado2').hide();
		$('#parceiro').hide();
		$input = $( data.input );
		value = $input.val();
		if(value && value.length > 5){
			$('div.ui-loader h1').text(embaralhaFrases());
			$('div.ui-loader').css("display","block");
			$('#listaCategoria').listview("refresh");
			listaRamoAtividades(value);
		};
	});
});	

$(document).on("pageinit","#contato",function(){	
	$('#enviadoOK').hide();
	$('#enviadoFalha').hide();
	
	$('#formContatoNome').click(function(){
		$('#enviadoOK').slideUp('fast');
		$('#enviadoFalha').slideUp('fast');
	});
	
	$('#btnEnviaContato').on("tap",function(){
		statusConexao();
		$('div.ui-loader h1').text(embaralhaFrases());
		$('div.ui-loader').css("display","block");
		nome= $('#formContatoNome').val();
		mensagem= $('#formContatoMensagem').val();
		telefone= $('#formContatoTelefone').val();
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