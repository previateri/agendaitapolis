var frases = [
	"Rastreando estrelas...", 
	"Pintando a lua...",
	"Enchendo balões...",
	"Retomando o fôlego...",
	"Comendo uma pizza...",
	"Foleando listas...",
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
	text: frases[sugestao],
	textVisible: true,
	theme: "b",
	html: ""
	});
	

function embaralhaFrases(){
	var sugestao = Math.ceil(Math.random() * frases.length);
	return frases[sugestao];
};	


$(document).on("pageinit","#home",function(){
	var count = true;
	var taps = 0;
	
	$('div.ui-loader').on("tap", function(){
		taps++;
		if(taps == 4){
			alert("Calma, assim você quebra! :D");
			taps=0;
		}
	});
	
	$('#btn1').on("tap", function(){
			taps = 0;
			$('div.ui-loader h1').text(embaralhaFrases());
			$('div.ui-loader').css("display","block");
			if(count){
				count = false;
				setTimeout(function() {
				$('div.ui-loader').css("display","none");	
				count = true;
				}, 4000);
			}
			var statusConnection = navigator.onLine;
			if(statusConnection){
			location.href="http://www.agendaitapolis.com.br/agenda.php"
			}	
		});	
});