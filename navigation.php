<!DOCTYPE html>
<html>
<head>
	<title>Google Maps Street Navigation</title>
	<style>
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		#map {
			height: 100%;
		}
	</style>
</head>
<body>
	<h1>Google Maps Street Navigation</h1>
	<div id="map"></div>

	<script>
		function initMap() {
			// Create a new map object
			var map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -34.397, lng: 150.644},
				zoom: 15
			});

			// Try HTML5 geolocation
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};

					var infowindow = new google.maps.InfoWindow({
						map: map,
						position: pos,
						content: 'Your location'
					});

					map.setCenter(pos);
				}, function() {
					handleLocationError(true, infowindow, map.getCenter());
				});
			} else {
				// Browser doesn't support Geolocation
				handleLocationError(false, infowindow, map.getCenter());
			}

			function handleLocationError(browserHasGeolocation, infoWindow, pos) {
				infoWindow.setPosition(pos);
				infoWindow.setContent(browserHasGeolocation ?
									  'Error: The Geolocation service failed.' :
									  'Error: Your browser doesn\'t support geolocation.');
			}

			// Add a street view service to the map
			var streetViewService = new google.maps.StreetViewService();

			map.addListener('click', function(event) {
				streetViewService.getPanorama({location: event.latLng, radius: 50}, function(result, status) {
					if (status === 'OK') {
						var panorama = new google.maps.StreetViewPanorama(
							document.getElementById('map'), {
								position: event.latLng,
								pov: {
									heading: 34,
									pitch: 10
								}
							});
						map.setStreetView(panorama);
					} else {
						window.alert('No street view available for this location.');
					}
				});
			});
		}
	</script>

	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhXHiHSxRtNWxaGYxuVdt3tH78ASij2Og&callback=jinja">
	</script>
</body>
</html>
