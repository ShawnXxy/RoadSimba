<?php
    $sql_loc = "SELECT * FROM $table_vehicles 
    JOIN $table_disp_carr ON $table_vehicles.user_ID = $table_disp_carr.carrier_ID
    JOIN $table_trucks_loc ON $table_trucks_loc.v_ID = $table_vehicles.v_ID
    JOIN $table_locations ON $table_trucks_loc.loc_ID = $table_locations.ID;";    
    $query_loc = mysqli_query($con, $sql_loc); 

    $return_arr = array();
    while ($row = mysqli_fetch_assoc($query_loc)) {
        $row_array['ZIP'] = $row['ZIP'];
        $row_array['lat'] = $row['lat'];
        $row_array['lon'] = $row['lon'];
        $row_array['city'] = $row['city'];
        $row_array['state'] = $row['state'];

        array_push($return_arr, $row_array);
    }
    $result = json_encode($return_arr);
    // var_dump($result);
?>

<div class="map-box" id="map"></div>

<script>
    var locations, map, infowindow, marker, i;;

    function initMap() {

        locations = <?php echo $result; ?>;

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: new google.maps.LatLng(39.8283, -98.5795),
            mapTypeId: 'terrain'
        });

        for (i = 0; i < locations.length; i++) {
            var lat = 
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lon']),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow = new google.maps.InfoWindow({
                        content: locations[i]['city'] + ', ' + locations[i]['state'] + " " + locations[i]['ZIP']
                    });
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    } 
    
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoVe8-O3eYkHkyc-f9VzQXh57Rp0QDNeg&callback=initMap">
</script>

<hr>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact</th>       
            <th>Vehicle Type / Size</th>
            <th>Date</th>
            <th>Location</th>
            <th>GPS</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Users data loading here -->
        <?php load_fleets(); ?>
    </tbody>
</table>

<?php delete_fleet(); ?>
    