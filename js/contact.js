	
   var map;
    map = new GMaps({
        el: '#map',
        lat: 51.514771,
        lng: -0.123790,
        scrollwheel: false
    });

    map.addMarker({
        lat: 51.514771,
        lng: -0.123790,
        title: 'Marker with InfoWindow',
        infoWindow: {
            content: '<p>Homezie Ltd,  71-75 Shelton Street, London, WC2H 9JQ<a href="#"  target="_blank"></a></p>'
        }
    });    