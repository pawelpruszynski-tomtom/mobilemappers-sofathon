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
				color: #000000;
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
            table, tr {
                border: 1px solid;
                border-color: #DF1B12;
                width: 100%;
                border-collapse: collapse;
                }



	</style>


</head>
<body>

<div class="header">
  <img src="1600_788261670403_2.png" alt="logo" />
</div>
<div class="row">
        <div class="column left">

			    <form action="/upload.php" method="post" enctype="multipart/form-data">
				    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" class="button-upload">
				    <input type="submit" value="Upload video" class="button-upload">
			    </form>


			    <form action="/download.php">
				    <input type="submit" value="Download video" class="button-download">
			    </form>

		</div>

		<div class="column middle">

            <table>
                            <tr>
                                   <th>Top contributors</th>
                            </tr>
                            <tr>
                                   <th>Author</th>
                                   <th>Videos</th>
                            </tr>
                            <tr>
                                <?php
                                    $xml=simplexml_load_file("top_contributors.xml") or die("Error: Cannot create object");
                                    foreach($xml->children() as $contributors)
                                    {
                                    echo "<tr><td>". $contributors->author . "</td> ";
                                    echo "<td>".  $contributors->numberofvideos . "</td> </tr>"; }
                                ?>
                            </tr>
            </table>
		</div>
        <div class="column right">
			<div id="map"  style="width: 1080px; height: 900px;"></div>
        </div>
</div>

<script src="leaflet_map.js"> </script>


<script>
let xhr = new XMLHttpRequest();
xhr.open('GET', 'FILE221005-051515F.geojson');
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.responseType = 'json';
xhr.onload = function() {
    if (xhr.status !== 200) return
    L.geoJSON(xhr.response).addTo(map);
};
xhr.send();
</script>


</body>
</html>
