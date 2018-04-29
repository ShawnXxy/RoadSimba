<?php

    // Showing all loads to Dispatchers / Carriers
    if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0 || $_SESSION['role'] == 99)  {
        $sql = "SELECT * FROM $table_loads;";
        $query = mysqli_query($con, $sql);
    }

    // Showing only loads to Brokers/Shippers posted
    if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
        $cur_user_ID = $_SESSION['user_ID'];
        $sql = "SELECT * FROM $table_loads WHERE post_by_ID = $cur_user_ID;";
        $query = mysqli_query($con, $sql);
    }

    $return_arr = array();

    while ($row = mysqli_fetch_assoc($query)) {
        $load_id = $row['load_ID'];
        $addr_pickup = $row['addr_pickup'];
        $city_pickup = $row['city_pickup'];
        $state_pickup = $row['state_pickup'];
        $zip_pickup = $row['zip_pickup'];

        // Pickup Location
        $sql_pickup = "SELECT * FROM $table_locations WHERE ZIP = $zip_pickup;";
        $query_pickup = mysqli_query($con, $sql_pickup);
        while ($row_pickup = mysqli_fetch_assoc($query_pickup)) {
            $row_array['lat'] = $row_pickup['lat'];
            $row_array['lon'] = $row_pickup['lon'];
    
            array_push($return_arr, $row_array);
        }
    }    
    
    $result = json_encode($return_arr);
    // var_dump($result);
?>

<div class="map-box" id="map">
</div>

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
            
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lon']),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow = new google.maps.InfoWindow({
                        content: "<a href='loads.php?source=details_load&load_ID=<?php echo $load_id; ?>'>Details</a>"
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
            <th>Post By</th>
            <th>Date Posted / Expired</th>
            <th>Pickup/Delivery Date</th>
            <th>Pickup Location</th>
            <th>Delivery Location</th>
            <th>Load Type / Vehicle Size</th>
            <th>Miles</th>
            <th>Pieces / Weight</th>
            <th>Price ($)</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Posts data loading here -->
        <?php view_loads(); ?>
    </tbody>
</table>

<?php delete_load(); ?>
    