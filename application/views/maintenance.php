<!--
  Desarrollado por: Luis Alberto Arrascue Bazan
  Cel: 959817779
  correo: abluis15@gmail.com
-->

<!DOCTYPE html>
<html lang="es">
	<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 	<style>
		/*TIPOGRAFÍAS*/
		@import url('https://fonts.googleapis.com/css?family=Noto+Sans');
		/*INICIALIZACIÓN DE ESTILOS*/
		*{
			margin:0;
			padding:0;
			box-sizing:border-box;
		}

		body{background-color:#f6f6f6;}

		/*PERSONALIZACIÓN DE P.MANTENIMIENTO*/
		.mantenimiento{
			width:600px;
			height:400px;
			padding:32px;
			border:1px solid #000;
			border-radius:10px;
			margin-top:-200px;
			margin-left:-300px;
			background-color:#fff;
			position:fixed;
			top:50%;
			left:50%;
		}
		.mantenimiento h1, .mantenimiento h2, .mantenimiento p{
			font-family:"noto sans", sans-serif;
		}

		.mantenimiento h1{
			font-size:3em;
			text-align:center;
			padding:16px;
		}
		.mantenimiento h2{
			font-size:2em;
			font-style:italic;
		}
		.mantenimiento p{
			margin:16px 0;
			line-height:1.5em;
		}

		#countdown{
			font-size: 25px;
			color: red;
		}
		
	</style>
</head>
<?php $PATH_BASE = dirname(APPPATH);?>
<body>
	<div class="mantenimiento">
		<div align="center"><img src="../public/images/ugel05_6.png" width="120" ></div>
		<h2 align="center"><b>Mesa de Partes Virtual</b></h2>
		<p align="justify">Estimados usuarios(as), estamos en mantenimiento.</p>
		<h3>Web disponible en:</h3>
		<br><br>		
		<div id="countdown"  align="center"></div>		
	</div>
</body>
</html>


<script>
var end = new Date('12/28/2020 08:00 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = days + ' dias, ';
        document.getElementById('countdown').innerHTML += hours + ' horas, ';
        document.getElementById('countdown').innerHTML += minutes + ' minutos y ';
        document.getElementById('countdown').innerHTML += seconds + ' segundos';
    }

    timer = setInterval(showRemaining, 1000);
</script>