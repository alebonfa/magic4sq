<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

	<?php
		echo 'DO MAIS BASICO <br>';
	?>

	<script>
		var a = 10.00;
	</script>

	<?php
		$a = "<script>document.write(a)</script>";
		echo 'Só a variavel A - ' . $a;
		echo '<br>'
	?>

	<?php
		include 'functions_GPS.php';
	?>

	<p id="demo">Click the button to get your coordinates:</p>

	<button onclick="getLocation($)">Try It</button>

	<script>
		var x = document.getElementById("demo");
		// var la = 0.00;
		// var lo = 0.00;

		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else {
				x.innerHTML="Geolocation is not supported by this browser.";
			}
		}
		
		function showPosition(position) {
			//var la = position.coords.latitude;
			//var lo = position.coords.longitude;

			//x.innerHTML =  "De:<br>";
			//x.innerHTML += "Latitude: " + la + "<br>";
			//x.innerHTML += "Longitude: " + lo + "<br>";
			//x.innerHTML +=  "<br>";
			//x.innerHTML +=  "Até:<br>";
			//x.innerHTML += "Latitude: " + la+0.01 + "<br>";
			//x.innerHTML += "Longitude: " + lo+0.01 + "<br>";
			//x.innerHTML +=  "<br>";
			//x.innerHTML +=  "Distância:<br>";
			// x.innerHTML +=  "<?php echo distanciaPontosGPS(la1, lo1, la2, lo2); ?>";
		}

	</script>

</body>
</html>