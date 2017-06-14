<!DOCTYPE HTML>
<html lang="pt-BR" manifest="manifest.txt">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Agenda Itápolis</title>
	<script type="text/javascript">
		var appCache = window.applicationCache;
		
		function atualiza(){
				localStorage.atualizado = "true";
				window.location.replace('http://m.agendaitapolis.com.br/agenda.php');
		}
	
		window.addEventListener('load', function(e) {
		  window.applicationCache.addEventListener('updateready', function(e) {
				if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
					window.applicationCache.swapCache();
					atualiza();
					window.location.reload();
				} else {
			}
		  }, false);
		   
		   window.applicationCache.addEventListener('noupdate', function(e) {
				atualiza();
            }, false);	
		
		}, false);
		
		setTimeout(function() {
			location.href="agenda.php";
			localStorage.atualizado = "true"
		}, 5000);
	</script>
</head>
<body style="background:#363636;color:#FFF;font-family:monospace">
	<p style="text-align:right;">Atualizando aplicativo...<br />Aguarde...</p>
</body>
</html>
