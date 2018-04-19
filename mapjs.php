 <script>
    $("#submit1").click(function(){
    if( $('#test1').val().length == 0 ){
    $('#test1').attr("placeholder", "Type waypoints");
    }else {
              $('#waypoints').append($('<option>', {
      value: $("#test1").val(),
      text: $("#test1").val(),
      selected:"selected"
      }));
      };
      });
      </script>
      
      <script>
      function initMap() {
      var directionsService = new google.maps.DirectionsService;
      var directionsDisplay = new google.maps.DirectionsRenderer;
      var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: {lat: 43.234381,lng: 76.890339}
      });
      directionsDisplay.setMap(map);
      document.getElementById('submit').addEventListener('click', function() {
      calculateAndDisplayRoute(directionsService, directionsDisplay);
      });
      }
      function compareRandom(a, b) {
      return Math.random() - 0.5;
      }
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
      var waypts = [];
      var checkboxArray = document.getElementById('waypoints');
      for (var i = 0; i < checkboxArray.length; i++) {
      if (checkboxArray.options[i].selected) {
      waypts.push({
      location: checkboxArray[i].value,
      stopover: true
      });
      if  (document.getElementById("myCheck").checked){
      waypts.sort(compareRandom);
      }
      }
      }
      if  (document.getElementById("myCheck").checked){
      var end = document.getElementById('test1').value;
      directionsService.route({
      origin: document.getElementById('start').value,
      destination: document.getElementById('end').value,
      waypoints: waypts.slice(1,end+1),
      optimizeWaypoints: true,
      travelMode: 'DRIVING'
      }, function(response, status) {
      if (status === 'OK') {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
      var routeSegment = i + 1;
      summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
      '</b><br>';
      summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
      summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
      summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
      } else {
      window.alert('Route ' + status+' please enter origin/destination points');
      }
      })
      } else{directionsService.route({
      origin: document.getElementById('start').value,
      destination: document.getElementById('end').value,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: 'DRIVING'
      }, function(response, status) {
      if (status === 'OK') {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
      var routeSegment = i + 1;
      summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
      '</b><br>';
      summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
      summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
      summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
      } else {
      window.alert('Route ' + status+' please enter origin/destination points');
      }
      })}
      ;
      }
      </script>
      <script src="js/mapi.js" type="text/javascript">
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-LW6fyInExELEgImDzU1sQ7jtSRTokOo&callback=initMap">
      </script>