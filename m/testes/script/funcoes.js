function embaralhaFrases(){
	var sugestao = Math.ceil(Math.random() * frases.length);
	return frases[sugestao];
};
function statusConexao(){
	var status = navigator.onLine;
	if(status == false){
		location.href="offline.html";
	}else{
		return true;
	}
};
function criaBanco(){
        db = openDatabase(shortName,version,displayName,maxSize);
        db.transaction(
            function(transaction){
                transaction.executeSql(
                    'CREATE TABLE IF NOT EXISTS agendaComercial ' +
                    '(id INTEGER NOT NULL UNIQUE,' +
                    'nome VARCHAR(80) NOT NULL,' +
                    'telefone VARCHAR(10) NOT NULL);'
                    );
                }
        );
    };    
function insereFavoritos(id,html,link){
		criaBanco()
        db.transaction(
			function(transaction){
				transaction.executeSql(
					'SELECT nome FROM agendaComercial WHERE id = ?;' ,[id],
					 function(transaction,result){
						if(result.rows.length > 0){
							return false;
						}else {
							db.transaction(
								function(transaction){
									transaction.executeSql(
										'INSERT INTO agendaComercial (id,nome,telefone) VALUES (?,?,?);',[id,html,link],
										function(){
											$('#favoritoAdicionado').slideDown('fast').slideUp('slow');
										}
									)
								}
							);
						}	
					}		
				);
			}
		);						
	};
function limpaFavoritos(){
		criaBanco();
		db.transaction(
			function(transaction){
				transaction.executeSql(
					'DELETE FROM agendaComercial',[],
						function(){
						return true;
					}
				)
			}
		);
		return true;
	}				
function removeFavorito(id){
		db.transaction(
			function(transaction){
				transaction.executeSql(
					'DELETE FROM agendaComercial WHERE id = ?',[id],
					 function(){
						$('#btnFechar').tap();
						$('#favoritoRemovido').slideDown('fast').slideUp('slow');
					}
				)
			}
		);
		listaFavoritos();
	};	
function listaFavoritos(){
		criaBanco();
        var html = "";		
		$('#ulFavoritos').html(html);
		$('#ulFavoritos').listview("refresh");
		$('#ulFavoritos').trigger("updatelayout");
		$('#ulFavoritos').hide();
		$('#ulFavoritos').slideDown();
		db.transaction(
			function(transaction){
				transaction.executeSql(
					'SELECT * FROM agendaComercial ORDER BY nome;',[],
						function(transaction, result){
							if(result.rows.length == 0){
							$('#painelFavoritos div.ui-body').show();
							}else{	
								for(var i=0; i<result.rows.length; i++){
									var row = result.rows.item(i);
									html += "<li><a id='"+row.id+"' class='ui-icon-phone' href='"+row.telefone+"'>"+row.nome+"</a></li>";
								}
								$('#ulFavoritos').html(html);
								$('#ulFavoritos').listview("refresh");
								$('#ulFavoritos').trigger("updatelayout");
								$('#ulFavoritos li.ui-li-divider').css('background','#22AADD');
								$('#ulFavoritos a').on("swiperight",function(e){
									var id = $(this).attr("id");
									$(this).on("vmouseup",function(e){
										removeFavorito(id);
									});
								});	
								$('#painelFavoritos div.ui-body').hide();
							}
						}
				);
			}
		);				
	};
function listaRamoAtividades(value){
		$('#btnVerTodos').show();
		statusConexao();
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
									$('#fb_parceiro').attr("href","fb://page/"+facebook);
									$('#local_parceiro').attr("href","mapa.php?local="+localizacao+"&parceiro="+obj.Nome+"&endereco="+endereco+"&telefone="+numTel);
									$('#discar_parceiro').attr("href","tel:"+numTel);
									$('#parceiro').show();
									$ul.hide()
								}else if(idTel){
									$ul.show();	
									html += "<li><a id='"+idTel+"'class='ui-icon-phone' href=tel:"+numTel+"><h2>"+obj.Nome+"</h2'>";
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
function hideElements(){
	$('#favoritoAdicionado').hide();
	$('#favoritoRemovido').hide();
	$('#tagsEncontradas').hide();
	$('#favoritoAdicionado2').hide();
    $('#nenhumResultado').hide();
	$('#nenhumResultado2').hide();
	$('#todasCategorias').hide();   
	$('#parceiro').hide();
}
function getOrientation(orientation){
	if(screen.orientation){
		if(orientation.orientation == "landscape"){
				navigator.vibrate([300, 200, 300]);
				window.location.replace('#pgGirar');
		}else if(orientation.orientation == "portrait"){
			window.location.replace('#categoria');
		}	
	}		
};