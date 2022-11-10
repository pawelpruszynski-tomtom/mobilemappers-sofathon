<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Upload awesome video</title>

	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}

		{
        box-sizing: border-box;
    	}

			.column {
			float: left;
			}


			.left {
			width: 20%;
			color: #FFFFFF;
			background-color: #FFFFFF;
			}

			.middle {
			width: 20%;
				color: #DF1B12;
				background-color: #FFFFFF;
			 }

			 .right {
			 width: 60%;
			 }

			.row:after {
			content: "";
			display: table;
			clear: both;
			}

			.button-upload {
  			background-color: #DF1B12;
  			border: none;
  			color: white;
  			padding: 10px 18px;
  			text-align: center;
  			text-decoration: none;
  			display: inline-block;
  			font-size: 14px;
 		 	margin: 2px 1px;
  			cursor: pointer;}

  			.button-download {
  			background-color: #00AAFF;
  			border: none;
  			color: white;
  			padding: 10px 18px;
  			text-align: center;
  			text-decoration: none;
  			display: inline-block;
  			font-size: 14px;
 		 	margin: 2px 1px;
  			cursor: pointer;
}
	</style>


</head>
<body>

<div class="header">
  <img src="1600_788261670403_2.png" alt="logo" />
</div>
<div class="row">
        <div class="column left">
			<p> <form action="/upload.php" method="post" enctype="multipart/form-data">
				<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" class="button-upload">
				<input type="submit" value="Upload video" class="button-upload">
			</form>
			</p>
			<p>
			<form action="/download.php">
				<input type="submit" value="Download video" class="button-download">
			</form>
			</p>
		</div>

		<div class="column middle">
			<?php
				$xml=simplexml_load_file("top_contributors.xml") or die("Error: Cannot create object");
				foreach($xml->children() as $contributors)
				{ echo $contributors->author . ", ";
				echo $contributors->numberofvideos . "<br>"; }
			?>
		</div>
        <div class="column right">
			<div id="map"  style="width: 1080px; height: 900px;"></div>
        </div>
    </div>



<script>

	const map = L.map('map').setView([51.75941493799874, 19.448758221409435], 15);

	const tiles = L.tileLayer('http://wmsmapproxy.ttg.global/mapproxy/basemap/wmts/Sydney/webmercator/{z}/{x}/{y}.png', {
		maxZoom: 18
	}).addTo(map);

	const marker = L.marker([51.75941493799874, 19.448758221409435]).addTo(map)
		.bindPopup('<b>TT office.</b>').openPopup();

	const circle = L.circle([51.75941493799874, 19.448758221409435], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 50
	}).addTo(map).bindPopup('Circle.');

	const polygon = L.polygon([
		[51.75951493799874, 19.448758221409435],
		[51.75941493799874, 19.448958221409435],
		[51.75931493799874, 19.448758221409435]
	]).addTo(map).bindPopup('Polygon.');


	const popup = L.popup()
		.setLatLng([51.75941493799874, 19.448758221409435])
		.setContent('TT office.')
		.openOn(map);

	function onMapClick(e) {
		popup
			.setLatLng(e.latlng)
			.setContent(`You clicked the map at ${e.latlng.toString()}`)
			.openOn(map);
	}

	map.on('click', onMapClick);

</script>



</body>
</html>