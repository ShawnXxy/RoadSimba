<?php
    if (isset($_GET['load_ID'])) {
        $edit_load_id = $_GET['load_ID'];
    }

    $sql = "SELECT * FROM $table_loads WHERE load_ID = $edit_load_id;";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        die('Query Failed ! ' . mysqli_error($con));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        $edit_load_id = $row['load_ID'];
        $date_post = date("Y-m-d\TH:i:s\Z", $row['date_post']);
        $date_exp = date("Y-m-d\TH:i:s\Z", $row['date_exp']);
        $date_pickup = date("Y-m-d\TH:i:s\Z", $row['date_pickup']);
        $date_delivery = date("Y-m-d\TH:i:s\Z", $row['date_delivery']);
        // $addr_pickup = $row['addr_pickup'];
        $city_pickup = $row['city_pickup'];
        $state_pickup = $row['state_pickup'];
        $zip_pickup = $row['zip_pickup'];
        // $addr_delivery = $row['addr_delivery'];
        $city_delivery = $row['city_delivery'];
        $state_delivery = $row['state_delivery'];
        $zip_delivery = $row['zip_delivery'];
        $load_type = $row['load_type'];
        $vehicle_size = $row['vehicle_size'];
        $miles = $row['miles'];
        $pieces = $row['pieces'];
        $load_weight = $row['load_weight'];
        $budget = $row['budget'];
        $note = $row['note'];
    }

    if (isset($_POST['edit_load'])) {
        $date_exp = strtotime(mysqli_real_escape_string($con, $_POST['date_exp']));

        $date_pickup = strtotime(mysqli_real_escape_string($con, $_POST['date_pickup']));
        $date_delivery = strtotime(mysqli_real_escape_string($con, $_POST['date_delivery']));

        $addrNum_pickup = mysqli_real_escape_string($con, $_POST['addrNum_pickup']);
        $addr_pickup = mysqli_real_escape_string($con, $_POST['addr_pickup']);
        $city_pickup = mysqli_real_escape_string($con, $_POST['city_pickup']);
        $state_pickup = mysqli_real_escape_string($con, $_POST['state_pickup']);
        $zip_pickup = mysqli_real_escape_string($con, $_POST['zip_pickup']);

        $addrNum_delivery = mysqli_real_escape_string($con, $_POST['addrNum_delivery']);
        $addr_delivery = mysqli_real_escape_string($con, $_POST['addr_delivery']);
        $city_delivery = mysqli_real_escape_string($con, $_POST['city_delivery']);
        $state_delivery = mysqli_real_escape_string($con, $_POST['state_delivery']);
        $zip_delivery = mysqli_real_escape_string($con, $_POST['zip_delivery']);

        $load_type = mysqli_real_escape_string($con, $_POST['load_type']);
        $vehicle_size = mysqli_real_escape_string($con, $_POST['vehicle_size']);
        $miles = mysqli_real_escape_string($con, $_POST['miles']);
        $pieces = mysqli_real_escape_string($con, $_POST['pieces']);
        $load_weight = mysqli_real_escape_string($con, $_POST['load_weight']);
        $budget = mysqli_real_escape_string($con, $_POST['budget']);

        $note = mysqli_real_escape_string($con, $_POST['note']);

        $sql_update_load = "UPDATE $table_loads SET 
            date_exp = '$date_exp', 
            date_pickup = '$date_pickup', 
            date_delivery = '$date_delivery', 
            addr_pickup = '$addrNum_pickup'" . "' '" . "'$addr_pickup', 
            city_pickup = '$city_pickup', 
            state_pickup = '$state_pickup', 
            zip_pickup = '$zip_pickup',
            addr_delivery = '$addrNum_delivery'" . "' '" . "'$addr_delivery', 
            city_delivery = '$city_delivery', 
            state_delivery = '$state_delivery', 
            zip_delivery = '$zip_delivery', 
            load_type = '$load_type', 
            vehicle_size = '$vehicle_size', 
            miles = '$miles',
            pieces = '$pieces', 
            load_weight = '$load_weight', 
            budget = '$budget', 
            note = '$note'
            WHERE load_ID = $edit_load_id;
            ";
        $query_update_load = mysqli_query($con, $sql_update_load);
        if (!$query_update_load) {
            die('Query Failed ! ' . mysqli_error($con));
        } else {
            echo "<p class='bg-success'>Updated successfully!</p>";
        }
    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <!-- <div class="form-group">
        <label for="post_by_ID">Company Name</label>
        <input type="text" class="form-control" name="post_by_ID" required>
    </div> -->

    <div class="form-group">
        <label for="date_exp">Date Expired (YYYY-MM-DD hh:mm)</label>
        <input type="text" class="form-control" name="date_exp" value="<?php echo $date_exp; ?>">
    </div>

    <div class="form-group">
        <label for="date_pickup">Pick Up (YYYY-MM-DD hh:mm)</label>
        <input type="text" class="form-control" name="date_pickup" value="<?php echo $date_pickup; ?>" required>
        <label for="date_delivery">Delivery (YYYY-MM-DD hh:mm)</label>
        <input type="text" class="form-control" name="date_delivery" value="<?php echo $date_delivery; ?>" required>
    </div>

    <div class="form-group">
        <label for="location_pickup">Pickup Location</label>
        <input type="text" class="form-control" id="autocomplete" placeholder="Enter address here" onFocus="geolocate()"></input>
        <input type="text" class="form-control" id="street_number" name="addrNum_pickup" placeholder="Street Number" disabled="true">
        <input type="text" class="form-control" id="route" name="addr_pickup" placeholder="Street Name" value="" disabled="true">
        <input type="text" class="form-control" id="locality" name="city_pickup" value="<?php echo $city_pickup; ?>" disabled="true">
        <input type="text" class="form-control" id="administrative_area_level_1" name="state_pickup" value="<?php echo $state_pickup; ?>" disabled="true">
        <input type="text" class="form-control" id="postal_code" name="zip_pickup" value="<?php echo $zip_pickup; ?>" disabled="true">
    </div>

    <div class="form-group">
        <label for="location_pickup">Delivery Location</label>
        <input type="text" class="form-control" id="autocomplete" placeholder="Enter address here" onFocus="geolocate()"></input>
        <input type="text" class="form-control" id="street_number" name="addrNum_delivery" placeholder="Street Number" disabled="true">
        <input type="text" class="form-control" id="route" name="addr_delivery" placeholder="Street Number" value="" disabled="true">
        <input type="text" class="form-control" id="locality" name="city_delivery" value="<?php echo $city_delivery; ?>" disabled="true">
        <input type="text" class="form-control" id="administrative_area_level_1" name="state_delivery" value="<?php echo $state_delivery; ?>" disabled="true">
        <input type="text" class="form-control" id="postal_code"  name="zip_delivery" value="<?php echo $zip_delivery; ?>" disabled="true">
    </div>

    <div class="form-group">
        <label for="load_info">Load Information</label>
        <input type="text" name="load_type" class="form-control" value="<?php echo $load_type; ?>" required>
        <input type="text" name="vehicle_size" class="form-control" value="<?php echo $vehicle_size; ?>" required>
        <input type="text" name="pieces" class="form-control" value="<?php echo $pieces; ?>" required>
        <input type="text" name="load_weight" class="form-control" value="<?php echo $load_weight; ?>" required>
    </div>

    <div class="form-group">
        <label for="miles">Miles</label>
        <input type="text" class="form-control" name="miles" value="<?php echo $miles; ?>" required>
    </div>

    <div class="form-group">
        <label for="budget">Price</label>
        <input type="text" class="form-control" name="budget" value="<?php echo $budget; ?>" required>
    </div>

    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" name="note" cols="30" rows="10" value="<?php echo $note; ?>"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="edit_load" value="Confirm">
    </div>
</form>
<script>
    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')),
            {types: ['geocode']}
        );
        // When the user selects an address from the dropdown, populate the address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
            }
        }
    }

      // Bias the autocomplete object to the user's geographical location, as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoVe8-O3eYkHkyc-f9VzQXh57Rp0QDNeg&libraries=places&callback=initAutocomplete" async defer>
</script>