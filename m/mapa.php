<?php
    $local = $_GET['local'];
    $parceiro = $_GET['parceiro'];
    $endereco = $_GET['endereco'];
    $telefone = $_GET['telefone'];
?>
<!DOCTYPE html>
<html>
  <head>
    <head>
		<meta charset="UTF-8">
		<title>Agenda Itápolis - Versão para Desktops</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="Acesse a Agenda Itápolis e tenha todos os telefones do comércio da cidade nas palmas de suas mãos, com 
        facilidade e agilidade."/>
        <meta name="keywords" content="lista itápolis, comércio itápolis, lojas itápolis, telefones de itápolis, lista online, agenda online"/>
        <meta name="robots" content="noindex">
        <meta name="author" content="Thiago Henrique Previateri">
		<meta  name = "mobile-web-app-capable"  content = "yes" > 
		<link  rel="icon"  sizes="192x192" href="img/icon-touch-v1.png"/>
		<link  rel="icon"  sizes="128x128" href="img/icon-touch-v2.png"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css"/>
		<link rel="stylesheet" href="css/home.css"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>
		<script type="text/javascript" src="script/home.js"></script>
	</head>
    <style>
      html, body, #container-mapa{
        width:100%;
        height: 500px;
        margin: 0px;
        padding: 0px
    }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=pt-BR"></script>
    <script>
    var map;
    function initialize() {
        navigator.geolocation.getCurrentPosition(sucesso);
        var mapOptions = {
            center: new google.maps.LatLng(-21.5958981,-48.8131365),
            zoom:14,
            panControl:false,
            zoomControl:true,
            mapTypeControl:false,
            scaleControl:false,
            streetViewControl:true,
            overviewMapControl:false,
            rotateControl:true,    
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('container-mapa'),
        mapOptions);
        
        function sucesso(position){
            var local_usuario_la = position.coords.latitude;
            var local_usuario_lo = position.coords.longitude;
            var local_usuario = new google.maps.LatLng(local_usuario_la,local_usuario_lo);
            marker2=new google.maps.Marker({
                position:local_usuario,     
                map:map,
                title:"Você está aqui?"
            });
            marker2.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');            
            marker2.setMap(map);
            
            
            var infowindow2 = new google.maps.InfoWindow({
            content:"Você está aqui?"
            });
            infowindow2.open(map,marker2)
            
        };
        
        var local_parceiro = new google.maps.LatLng(<?php echo $local ?>);
        marker=new google.maps.Marker({
            position:local_parceiro,
            animation:google.maps.Animation.BOUNCE,
            map:map,
            title:"<?echo $parceiro ?>"
        });
        marker.setMap(map);
        
       
        
        var infowindow = new google.maps.InfoWindow({
            content:'<?php echo "<p><strong>$parceiro</strong><br/>$endereco<br/><a href=\"tel:$telefone\">$telefone</a>";?>' 
        });
        infowindow.open(map,marker);     
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	</head>
  <body>
    <div data-role="page" id="mapa" style="width:100%; height:100%";>
            <div data-role="header" data-theme="b">
               <a href='#' data-rel='back'  class='ui-btn ui-shadow ui-corner-all ui-icon-arrow-l ui-btn-icon-notext'></a>
                <h1>Localização</h1>
            </div>
            <section data-role="content">
                <div data-form="ui-body-a" class="ui-body ui-body-a ui-corner-all" id="container-mapa">
                </div>
            </section>    
        </div>
  </body>
</html>