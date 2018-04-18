function calcRoute() {
    var start = document.getElementById('start').value;
    var end = document.getElementById('end').value;
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
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
