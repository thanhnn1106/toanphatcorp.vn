/*
HTML based map tool for Google Maps API v3
@version: 1.0.1
@author: Takuma Ando (Freesale,Inc.)
@licensed: http://www.opensource.org/licenses/mit-license.php
@created: 2016-06-29
@modified: 2016-07-06
*/
/*
Usage: If you need to render maps automatically, you should set gmaps.renderAll to the callback paramater in google maps api script url.
*/
!function(){
	var gmaps = {};
	gmaps.maps = [];
	gmaps.renderAll = function(){
		var elems = document.querySelectorAll('.gMap');
		for(var i = 0,elem; elem = elems[i]; i++) {
			gmaps.maps.push(gmaps.render(elem));
		}
	};
	gmaps.render = function(elem){
		var options = {
						zoom: 15,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						mapTypeControl: false,
						navigationControl: true,
						scaleControl: false,
						scrollwheel: true,
						streetViewControl: false
					},
			behaviors = {};
		
		var _className = elem.getAttribute('class');
		
		if(_className.match(/gMapZoom(\d+)/)){
			options.zoom = RegExp.$1 - 0;
		}
		
		if(_className.match(/gMapNavigation([a-z]+)/)){
			options.navigationControlOptions = {
				style: eval('google.maps.NavigationControlStyle.' + RegExp.$1.toUpperCase())
			};
		}
		
		if(_className.match(/gMapDisableScrollwheel/)){
			options.scrollwheel = false;
		}
		
		if(_className.match(/gMapEnableStreetView/)){
			options.streetViewControl = true;
		}
		
		if(_className.match(/gMapEnableMapType/)){
			options.mapTypeControl = true;
		}
		
		if(_className.match(/gMapEnableScale/)){
			options.scaleControl = true;
		}
		
		behaviors.minifyInfoWindow = _className.match(/gMapMinifyInfoWindow/) ? true : false;
		
		var center = gmaps.getCenter(elem);
		if( center ) {
			options.center = center;
		}
		var markers = gmaps.getMarkers(elem);
		
		var mapSet = {
			map: new google.maps.Map(elem, options),
			markers: [],
			infoWindows: []
		};
		mapSet.map = new google.maps.Map(elem, options);
		for(var i = 0, marker; marker = markers[i]; i++) {
			!function(){
				var infoWindow = marker.infoWindow;
				if( marker.infoWindow )
					delete marker.infoWindow;
				marker.map = mapSet.map;
				var markerObject = new google.maps.Marker(marker);
				mapSet.markers.push(markerObject);
				
				if( infoWindow ) {
					var infoWindowObject = new google.maps.InfoWindow({
						content: infoWindow.innerHTML
					});
					mapSet.infoWindows.push(infoWindow);
					google.maps.event.addListener(markerObject, 'click', function(){
						infoWindowObject.open(markerObject.getMap(), markerObject);
					});
				}
			}();
		}
		
		if( !behaviors.minifyInfoWindow && mapSet.infoWindows.length ) {
			google.maps.event.trigger(mapSet.markers[0], 'click');
		}
		
		return mapSet;
	};
	gmaps.getCenter = function(parentElement) {
		var elem = parentElement.querySelector('.gMapCenter');
		if( elem ) {
			return gmaps.getLatLng(elem);
		}
		return null;
	};
	gmaps.getLatLng = function(parentElement) {
		var elem = parentElement.querySelector('.gMapLatLng');
		if( elem ){
			var html = elem.innerHTML;
			//Remove tags, iOS may has <a>
			html = html.replace(/<[^<>]+?>/g, '').replace(/^[\s]*(.*?)[\s]*$/g, '$1');
			var point = html.split(',');
			if( point.length == 2 ) {
				return {
					lat: point[0] - 0,
					lng: point[1] - 0
				};
			}
			return latlng;
		}
		return [0,0];
	};
	gmaps.getMarkers = function(parentElement) {
		var elems = parentElement.querySelectorAll('.gMapMarker'),
			markers = [],
			options;
		for(var i = 0, elem; elem = elems[i]; i++ ) {
			options = {
				position: gmaps.getLatLng(elem),
				infoWindow: gmaps.getInfoWindow(elem),
			};
			var icon = gmaps.getIcon(elem);
			if( icon )
				options.icon = icon;
			markers.push(options);
		}
		return markers;
	};
	gmaps.getInfoWindow = function(parentElement) {
		return parentElement.querySelector('.gMapInfoWindow');
	};
	gmaps.getIcon = function(parentElement) {
		var elem = parentElement.querySelector('.gMapIcon');
		if( elem ) {
			return elem.getAttribute('src');
		}
		return false;
	};
	
	window.gmaps = gmaps;
}();