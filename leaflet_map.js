const map = L.map('map').setView([45.679605, 8.708564], 17);

	const tiles = L.tileLayer('http://wmsmapproxy.ttg.global/mapproxy/basemap/wmts/Sydney/webmercator/{z}/{x}/{y}.png', {
		maxZoom: 18
	}).addTo(map);

    var geojsonFeature = {
        "type": "Feature",
        "properties": {
        "name": "TT geojson",
        "amenity": "TT office",
        "popupContent": "This TT office json!"
        },
        "geometry": {
        "type": "Point",
        "coordinates": [8.708564, 45.679605]
        }
        };

    const geojson = L.geoJSON(geojsonFeature).addTo(map);


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
