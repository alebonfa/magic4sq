<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<link rel="stylesheet" type="text/css" href="app.css">

</head>
<body>

	<p id="demo"></p>

	<button onclick="getLocation()">Refresh</button>

    <script src="http://underscorejs.org/underscore-min.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

	<script>

		$(document).ready(function(){
			var x = document.getElementById("demo");
			getLocation();

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
				x.innerHTML = 'Vai começar a festa!<br><br>';

				places = [];

	            $.ajax({
	                type: "POST",
	                dataType: "json",
	                url: "closePlaces.php",
	                data: {la: la, lo: lo},
			        cache: false,
		            success: function(data) {
		                places = [];
		                _.each( data, function(item, ix, list) {
		                    places.push(item.name);
		                    x.innerHTML += '<div class="closePlaceList"><a href="hta.php?laF=' + la + '&loF=' + lo + '&laT=' + item.lat + '&loT=' + item.lng + '" > ' + item.name + '</a></div><br>';;
		                    // x.innerHTML += '<div class="closePlaceList">' + item.name + '</div>';
		                    x.innerHTML += Math.round(distanceTwoPoints(la, lo, item.lat, item.lng),2) + ' metros <br><br>';
		                });
		            }
		        });

			}

			function distanceTwoPoints(LaF, LoF, LaT, LoT) {
		        var earthRadius = 6372.795477598;
		        var latFrom = LaF * Math.PI / 180;
		        var lonFrom = LoF * Math.PI / 180;
		        var latTo = LaT * Math.PI / 180;
		        var lonTo = LoT * Math.PI / 180;
		  
		        var lonDelta = lonTo - lonFrom;
		        var a = Math.pow(Math.cos(latTo) * Math.sin(lonDelta), 2) + Math.pow(Math.cos(latFrom) * Math.sin(latTo) - Math.sin(latFrom) * Math.cos(latTo) * Math.cos(lonDelta), 2);
		        var b = Math.sin(latFrom) * Math.sin(latTo) + Math.cos(latFrom) * Math.cos(latTo) * Math.cos(lonDelta);
		        var angle = Math.atan2(Math.sqrt(a), b);

		        return angle *  earthRadius * 1000;
			}

		})


	</script>

</body>
</html>