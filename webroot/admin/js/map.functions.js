var map;
var geocoder;
var defaultCenter = {
	lat: -14.235004,
	lng: -51.92528
};
var country = "Brasil";
var marker = null;

function codeAddress(country, state, zipCode, city, district, number, address) {
	completeAddress = address + ', ' + number + ', ' + district + (city.length ?  ', ' + city : null) + ', ' + zipCode + ', ' + state + ', ' + country;
	
	geocoder.geocode({'address': completeAddress}, function(results, status) {
		if (status == 'OK') {
			map.setCenter(results[0].geometry.location);
			map.setZoom(14);

			if (address) {
				removeMarker();
				placeMarker(results[0].geometry.location);
			}
		} else {
			console.log(status);
			// alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}

function placeMarker(location) {
	marker = new google.maps.Marker({
		position: location, 
		map: map,
		draggable: true,
	});
	map.panTo(location);
	$('.control-latlng').val(location.toString().replace(/[{()}]/g, ''));

	marker.addListener('dragend', function(mapsMouseEvent) {
		$('.control-latlng').val(mapsMouseEvent.latLng.toString().replace(/[{()}]/g, ''));
		map.panTo(mapsMouseEvent.latLng);
	});
}

function removeMarker(location) {
	if (marker != null) {
		marker.setMap(null);
	}
	$('.control-latlng').val('');
}

function initMap() {
	geocoder = new google.maps.Geocoder();

	map = new google.maps.Map(document.getElementById('mMap'), {
		center: defaultCenter,
		zoom: 4,
		streetViewControl: true,
	});

	map.addListener('click', function(mapsMouseEvent) {
		removeMarker();
		placeMarker(mapsMouseEvent.latLng);
	});

	if ($(".control-latlng").val() && typeof map != 'undefined') {
		stringLatLng = $('.control-latlng').val().split(/, ?/)
		latLng = {
			lat: parseFloat(stringLatLng[0]),
			lng: parseFloat(stringLatLng[1])
		};

		map.setCenter(latLng);
		map.setZoom(14);
		placeMarker(latLng);
	}
}

$(function() {
	$('.map-control-state').on('change', function() {
		removeMarker();

		map.panTo(defaultCenter);
		map.setZoom(4);
	});

	// $(document).on('change', 'select.map-control-city', function() {
	// 	var state = $('.map-control-state option:selected').text();
	// 	var city = $(this).find('option:selected').text();

	// 	if ($('.control-address').val().length > 0) {
	// 		address = $('.control-address').val();
	// 		codeAddress(country, state, city, address);
	// 	}
	// 	else {
	// 		codeAddress(country, state, city);
	// 	}

	// 	removeMarker();
	// });

	var timeout;
	$('input.location').on('keyup change', function() {
		var empties = $('input.location').filter(function () {
			return $.trim($(this).val()).length == 0
		});

		$('.map-overlay').fadeIn(300);

		if (empties.length == 0) {
			if (typeof timeout == 'number') {
				clearTimeout(timeout);
			}

			var state = $('input.location-state').val();
			var city = $('input.location-city').val() ?? '';
			var district = $('input.location-district').val();
			var zipCode = $('input.location-zip-code').val();
			var address = $('input.location-address').val();
			var number = $('input.location-number').val();

			timeout = setTimeout(function() {
				codeAddress('Brasil', state, zipCode, city, district, number, address);

				$('.map-overlay').fadeOut(300);
			}, 1000);
		}
	});
});