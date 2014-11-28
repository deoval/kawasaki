<!DOCTYPE html> 
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0 }
            #map_canvas { height: 100% }
        </style>
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?sensor=false">
        </script>
        <script type="text/javascript">
            function initialize() {
                $geocoder = new google.maps.Geocoder();
                $directionsService = new google.maps.DirectionsService();
                $directionsDisplay = new google.maps.DirectionsRenderer();

                var mapOptions = {
                    center: new google.maps.LatLng(-30.0277041, -51.228734599999996),
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                var $map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
                
                var comoChegar = function ($lat, $lng) {

                    /*
                     if (typeof initialLocation === "undefined" && $("#search").val() == "") {
                     alert("Preencha o endereço para traçar a rota!");
                     return false;
                     }
                     */

                    $directionsDisplay.setMap(null); // RESETA DIRECTION ANTERIOR
                    $directionsDisplay.setMap($map);

                    // $directionsDisplay.setPanel(document.getElementById("directions"));

                    // document.getElementById("directions").innerHTML = "";
                    // document.getElementById("directions").style.display = "block"

                    //var $origin = codeAddress('Rua saldanha da gama 853, São José, Porto Alegre - RS');
                    //var $destination = codeAddress('Rua portugal 423, São João, Porto Alegre - RS');
                    //return false;

                    $directionsService.route({
                        origin: 'Rua saldanha da gama 853, São José, Porto Alegre - RS',
                        destination: 'Rua portugal 423, São João, Porto Alegre - RS',
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    }, function (response, status) {
                        if (status == google.maps.DirectionsStatus.OK)
                            $directionsDisplay.setDirections(response);
                    });
                };

                var codeAddress = function (address) {
                    $geocoder.geocode({
                        'address': address
                    }, function (results, status) {
                            //console.log(results);
                        if (status == google.maps.GeocoderStatus.OK) {
                            alert(results[0].geometry.location);
                            //map.setCenter(results[0].geometry.location);
                            //map.setZoom(14);
                            /*var marker = new google.maps.Marker({
                             map : map,
                             position : results[0].geometry.location
                             }); */
                        } else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
                
                comoChegar(0,0);
            }
        </script>
    </head>
    <body onload="initialize()">
        <div id="map_canvas" style="width:100%; height:100%"></div>
    </body>
</html>