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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

	<script>

		$(document).ready(function(){
			var x = document.getElementById("demo");
            var places = new Array();
			var la, lo;


			getLocation();

			function getLocation() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else {
					x.innerHTML="Geolocation is not supported by this browser.";
				}
			}
			
			function loadRoute() {
				var placeID = $(this).attr('id');
				var mapSpace = 'map' + placeID;
				$('#'+mapSpace).addClass('mapsRoute');
				var laF = la;
				var loF = lo;
                for(var i=0; i<places.length; i++) {
                	if(places[i][0] === placeID) {
                		laT = places[i][2];
                		loT = places[i][3];
                	}
                }

		      	var map; 
		      	var sp2 = new google.maps.LatLng(laF, loF);
		      	var sp3 = new google.maps.LatLng(laT, loT);
		      	var directionDisplay;
		      	var directionsService = new google.maps.DirectionsService();

	        	directionsDisplay = new google.maps.DirectionsRenderer();
	        	var myOptions = { 
	          		zoom: 15, 
	          		center: sp2, 
	          		mapTypeId: google.maps.MapTypeId.ROADMAP
	        	}; 

	        	map = new google.maps.Map(document.getElementById(mapSpace), myOptions); 
	        	directionsDisplay.setMap(map);

	        	var request = {
	          		origin: sp2, 
	         		destination: sp3,
	          		travelMode: google.maps.DirectionsTravelMode.DRIVING
	        	};

	        	directionsService.route(request, function(response, status) {
	          		if (status == google.maps.DirectionsStatus.OK) {
	            		directionsDisplay.setDirections(response);
	          		} else {
	            		alert(status);
	          		}
	        	});

			}

			function showPosition(position) {
				la = position.coords.latitude;
				lo = position.coords.longitude;

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
		                    places.push([item.id, item.name, item.lat, item.lng, Math.round(distanceTwoPoints(la, lo, item.lat, item.lng),2)]);
		                });
		                places.sort(function(a,b){
		                	if(a[4]==b[4]) return 0;
		                	return a[4] < b[4] ? -1 : 1;
		                });
		                for(var i=0; i<places.length; i++) {
		                    x.innerHTML += '<div class="closePlaceList" id="' + places[i][0] + '">' + places[i][1] + '</div>';
		                    x.innerHTML += '<div class="distance">' + places[i][4] + ' metros </div>';
		                    x.innerHTML += '<div id="map' + places[i][0] + '"></div>';
		                }
		                var allPlaces = document.getElementsByClassName('closePlaceList');
		                for(var i=0; i<allPlaces.length;i++) {
		                	allPlaces[i].addEventListener("click", loadRoute, false) ;
		                }
		            }
		        })
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