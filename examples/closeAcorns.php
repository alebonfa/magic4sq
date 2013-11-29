<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

	<p id="demo">Click the button to get your coordinates:</p>

	<button onclick="getLocation()">Try It</button>

	<script>
		var x = document.getElementById("demo");

		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else {
				x.innerHTML="Geolocation is not supported by this browser.";
			}
		}
		
		function showPosition(position) {
			var la = position.coords.latitude;
			var lo = position.coords.longitude;
			x.innerHTML = 'De: <br>' ;
			x.innerHTML += 'Latitude: ' + la + '<br>';
			x.innerHTML += 'Longitude: ' + lo + '<br>';
			x.innerHTML += 'Até: <br>' ;
			x.innerHTML += 'Latitude: ' + (la+0.01) + '<br>';
			x.innerHTML += 'Longitude: ' + (lo+0.01) + '<br>';
			x.innerHTML += '<br>' ;
			x.innerHTML += 'Distância: ' + distanceTwoPoints(la, lo, (la+0.01), lo+0.01) + '<br>';
		}

		function distanceTwoPoints(Choba, LoF, LaT, LoT) {
	        var earthRadius = 6372.795477598;
	        var latFrom = Choba * Math.PI / 180;
	        var lonFrom = LoF * Math.PI / 180;
	        var latTo = LaT * Math.PI / 180;
	        var lonTo = LoT * Math.PI / 180;
	  
	        var lonDelta = lonTo - lonFrom;
	        var a = Math.pow(Math.cos(latTo) * Math.sin(lonDelta), 2) + Math.pow(Math.cos(latFrom) * Math.sin(latTo) - Math.sin(latFrom) * Math.cos(latTo) * Math.cos(lonDelta), 2);
	        var b = Math.sin(latFrom) * Math.sin(latTo) + Math.cos(latFrom) * Math.cos(latTo) * Math.cos(lonDelta);
	        var angle = Math.atan2(Math.sqrt(a), b);

	        return angle *  earthRadius * 1000;
		}

	</script>

</body>
</html>