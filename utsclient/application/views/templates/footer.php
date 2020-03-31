<!-- Footer -->

<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!-- Title -->
	<title>Halam User</title>

	<!-- Favicon -->
	<link rel="icon" href="img/core-img/logo.png">

	<!-- Core Stylesheet -->
	<link rel="stylesheet" href="style.css">

</head>
</section>


<div id="map" style="width:100%;height:520px"></div>

<script>
	function initMap() {
		var mapOptions = {
			zoom: 10,
			center: new google.maps.LatLng(-7.946529, 112.6142412),
			mapTypeId: 'roadmap'
		};
		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		var Malang = {
			lat: -7.946529,
			lng: 112.6142412
		};
		var marker = new google.maps.Marker({
			position: Malang,
			map: map,

		});

		var contentString = '<h3>POLINEMA</h3>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
	}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiUgfO_EMGmXgf8UtttT-CcnnOlMwEjgw&callback=initMap"></script>
<!-- <hr> -->
</section>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>