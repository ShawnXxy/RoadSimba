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
        $addr_pickup = $row['addr_pickup'];
        $city_pickup = $row['city_pickup'];
        $state_pickup = $row['state_pickup'];
        $zip_pickup = $row['zip_pickup'];
        $addr_delivery = $row['addr_delivery'];
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

    // Pickup Location
    $sql_pickup = "SELECT * FROM $table_locations WHERE ZIP = $zip_pickup;";
    $query_pickup = mysqli_query($con, $sql_pickup);
    if (!$query_pickup) {
        die('Query Failed ! ' . mysqli_error($con));
    }
    while ($row_pickup = mysqli_fetch_assoc($query_pickup)) {
        $lat_pickup = $row_pickup['lat'];
        $lon_pickup = $row_pickup['lon'];
    }

    // Delivery Location
    $sql_delivery = "SELECT * FROM $table_locations WHERE ZIP = $zip_delivery;";
    $query_delivery = mysqli_query($con, $sql_delivery);
    if (!$query_delivery) {
        die('Query Failed ! ' . mysqli_error($con));
    }
    while ($row_delivery = mysqli_fetch_assoc($query_delivery)) {
        $lat_delivery = $row_delivery['lat'];
        $lon_delivery = $row_delivery['lon'];
    }

?>
<div class="map-box">
    <div class="map">
    <!-- MAP goes here -->
    <iframe width="100%" height="250" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/directions?origin=<?php echo $zip_pickup; ?>&destination=<?php echo $zip_delivery; ?>&key=AIzaSyBOqr6-5M1V3fk4917iXkiE1kMLG-Vz1DM" allowfullscreen></iframe>
    </div>
</div>
<hr>

<table class="table table-bordered table-hover">
    <tbody>
        <tr>
            <td>Pick-up time</td>
            <td><?php echo $date_pickup; ?></td>
        </tr>
        <tr>
            <td>Delivery time</td>
            <td><?php echo $date_delivery; ?></td>
        </tr>
        <tr>
            <td>Pick-up location</td>
            <td><?php echo $addr_pickup . ", " . $city_pickup . ", " . $state_pickup . " " . $zip_pickup; ?></td>
        </tr>
        <tr>
            <td>Delivery location</td>
            <td><?php echo $addr_delivery . ", " . $city_delivery . ", " . $state_delivery . " " . $zip_delivery; ?></td>
        </tr>
        <tr>
            <td>Load Info</td>
            <td>Type : <?php echo $load_type; ?> <br>
            Vehicle Size: <?php echo $vehicle_size; ?><br>
            Weight: <?php echo $pieces; ?><br>
            Pieces: <?php echo $load_weight; ?>
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td> $ <?php echo $budget; ?></td>
        </tr>
        <tr>
            <td>Note</td>
            <td><?php echo $note; ?></td>
        </tr>
    </tbody>
</table>

<div class="form-group">
    <input type="submit" class="btn btn-success" name="bid" value="Bid">
</div>