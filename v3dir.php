<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-LW6fyInExELEgImDzU1sQ7jtSRTokOo&callback=initMap"></script>
<!--    // from https://github.com/bjornharrtell/jsts  -->
<script src="http://www.geocodezip.com/scripts/javascript.util.js"></script>
<script src="http://www.geocodezip.com/scripts/jsts.js"></script>
<script>
var map;
var gmarkers = [];
var routePolygon = null;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
// Define a symbol using SVG path notation, with an opacity of 1.
var lineSymbol = {
    path: 'M 0,-1 0,1',
    strokeOpacity: 1,
    scale: 4
};
var dashedPolyline = {
    strokeOpacity: 0,
    icons: [{
      icon: lineSymbol,
      offset: '0',
      repeat: '20px'
    }]
};

    /* === markers === */
    var locations = [
        ['1', 40.577651, -82.200443],
        ['2', 40.760976, -93.911868],
        ['3', 39.110017, -111.116458],
        ['4', 27.036116, -81.717045],
        ['5', 34.104058, -117.444583],
        ['6', 44.790790, -121.443607],
        ['7', 40.735657, -74.172367] ];

function initialize() {
    var mapCanvas = "map-canvas";
    var mapLat = 45.12381;
    var mapLng = -123.11379;

    var point = new google.maps.LatLng(mapLat, mapLng);

    var mapOptions = {
        zoom: 4,
        center: point,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions:dashedPolyline});
    var chicago = new google.maps.LatLng(41.850033, -87.6500523);
    var mapOptions = {
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: chicago
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var marker, i;

    for (i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({
            // map: map,
            title: locations[i][0],
            position: new google.maps.LatLng(locations[i][1], locations[i][2])
            //visible: false,  //true for all, but hidden
            // icon: 'img/the_icon.png'
        });
        gmarkers.push(marker);
        var marker = new google.maps.Marker({
            map: map,
            title: locations[i][0],
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            icon: {
              url: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle.png",
              size: new google.maps.Size(7,7),
              anchor: new google.maps.Point(3.5,3.5)
            }
        });

    }

    directionsDisplay.setMap(map);
    var origin = document.getElementById('start').value;
    var destination = document.getElementById('end').value;
    var waypts = [];
      // If there are any parameters at the end of the URL, they will be in  location.search
      // looking something like  "?marker=3"

      // skip the first character, we are not interested in the "?"
      var query = location.search.substring(1);

      // split the rest at each "&" character to give a list of  "argname=value"  pairs
      var pairs = query.split("&");
      for (var i=0; i<pairs.length; i++) {
        // break each pair at the first "=" to obtain the argname and value
	var pos = pairs[i].indexOf("=");
	var argname = pairs[i].substring(0,pos).toLowerCase();
	var value = pairs[i].substring(pos+1).toLowerCase();

        // process each possible argname  -  use unescape() if theres any chance of spaces
        if (argname == "origin") {origin = unescape(value);}
        if (argname == "destination") {destination = unescape(value);}
        if (argname =="waypt") {waypts.push({location:unescape(value), stopover:true});}
      }
    calcRoute(origin,destination,waypts);
}

function googleMaps2JTS(boundaries) {
    var coordinates = [];
    var length = 0;
    if (boundaries && boundaries.getLength) length = boundaries.getLength();
    else if (boundaries && boundaries.length) length = boundaries.length;
    for (var i = 0; i < length; i++) {
        if (boundaries.getLength) coordinates.push(new jsts.geom.Coordinate(
        boundaries.getAt(i).lat(), boundaries.getAt(i).lng()));
        else if (boundaries.length) coordinates.push(new jsts.geom.Coordinate(
        boundaries[i].lat(), boundaries[i].lng()));
    }
    return coordinates;
};
var jsts2googleMaps = function (geometry) {
  var coordArray = geometry.getCoordinates();
  GMcoords = [];
  for (var i = 0; i < coordArray.length; i++) {
    GMcoords.push(new google.maps.LatLng(coordArray[i].x, coordArray[i].y));
  }
  return GMcoords;
}
function calcRoute(start, end, waypts) {

    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    if (waypts && waypts.length > 0) {
      request.waypoints = waypts;
    }
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var overviewPath = response.routes[0].overview_path,
                overviewPathGeo = [];
            for (var i = 0; i < overviewPath.length; i++) {
                overviewPathGeo.push(
                [overviewPath[i].lng(), overviewPath[i].lat()]);
            }

            var distance = 10 / 111.12, // Roughly 10km
                geoInput = {
                    type: "LineString",
                    coordinates: overviewPathGeo
                };
            var geoInput = googleMaps2JTS(overviewPath);
            var geometryFactory = new jsts.geom.GeometryFactory();
            var shell = geometryFactory.createLineString(geoInput);
            var polygon = shell.buffer(distance);

            var oLanLng = [];
            var oCoordinates;
            oCoordinates = polygon.shell.points[0];
            for (i = 0; i < oCoordinates.length; i++) {
                var oItem;
                oItem = oCoordinates[i];
                oLanLng.push(new google.maps.LatLng(oItem[1], oItem[0]));
            }
            if (routePolygon && routePolygon.setMap) routePolygon.setMap(null);
            routePolygon = new google.maps.Polygon({
                paths: jsts2googleMaps(polygon),
                map: map
            });
            for (var j=0; j< gmarkers.length; j++) {
              if (google.maps.geometry.poly.containsLocation(gmarkers[j].getPosition(),routePolygon)) {
                gmarkers[j].setMap(map);
              } else {
                gmarkers[j].setMap(null);
              }
           }
        }
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="panel">
    <b>Start: </b>
    <select id="start" onchange="calcRoute(document.getElementById('start').value,document.getElementById('end').value);">
      <option value="new york, ny">New York</option>
      <option value="chicago, il">Chicago</option>
      <option value="st louis, mo">St Louis</option>
      <option value="joplin, mo">Joplin, MO</option>
      <option value="oklahoma city, ok">Oklahoma City</option>
      <option value="amarillo, tx">Amarillo</option>
      <option value="gallup, nm">Gallup, NM</option>
      <option value="flagstaff, az">Flagstaff, AZ</option>
      <option value="winona, az">Winona</option>
      <option value="kingman, az">Kingman</option>
      <option value="barstow, ca">Barstow</option>
      <option value="san bernardino, ca">San Bernardino</option>
      <option value="los angeles, ca">Los Angeles</option>
    </select>
    <b>End: </b>
    <select id="end" onchange="calcRoute(document.getElementById('start').value,document.getElementById('end').value);">
      <option value="new york, ny">New York</option>
      <option value="chicago, il">Chicago</option>
      <option value="st louis, mo" selected="selected">St Louis</option>
      <option value="joplin, mo">Joplin, MO</option>
      <option value="oklahoma city, ok">Oklahoma City</option>
      <option value="amarillo, tx">Amarillo</option>
      <option value="gallup, nm">Gallup, NM</option>
      <option value="flagstaff, az">Flagstaff, AZ</option>
      <option value="winona, az">Winona</option>
      <option value="kingman, az">Kingman</option>
      <option value="barstow, ca">Barstow</option>
      <option value="san bernardino, ca">San Bernardino</option>
      <option value="los angeles, ca">Los Angeles</option>
    </select>
    </div>
    <div id="map-canvas"></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-162157-1";
urchinTracker();
</script>
  </body>
</html>