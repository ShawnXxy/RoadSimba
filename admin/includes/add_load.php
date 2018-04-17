
<form action="" method="post" enctype="multipart/form-data">
    <!-- Insert post -->
    <?php insert_load(); ?>
    <!-- <div class="form-group">
        <label for="post_by_ID">Company Name</label>
        <input type="text" class="form-control" name="post_by_ID" required>
    </div> -->

    <div class="form-group">
        <label for="date_exp">Date Expired</label>
        <input type="text" class="form-control" name="date_exp">
    </div>

    <div class="form-group">
        <!-- <label for="date">Date</label> -->
        <input type="text" class="form-control" name="date_pickup" placeholder="Pickup Date" required>
        <input type="text" class="form-control" name="date_delivery" placeholder="Delivery Date" required>
    </div>

    <div class="form-group">
        <label for="location_pickup">Pickup Location</label>
        <input type="text" class="form-control" name="addr_pickup" placeholder="Street" required>
        <input type="text" class="form-control" name="city_pickup" placeholder="City" required>
        <input type="text" class="form-control" name="state_pickup" placeholder="State" required>
        <input type="text" class="form-control" name="zip_pickup" placeholder="Zip Code" required>
    </div>

    <div class="form-group">
        <label for="location_pickup">Delivery Location</label>
        <input type="text" class="form-control" name="addr_delivery" placeholder="Street" required>
        <input type="text" class="form-control" name="city_delivery" placeholder="City" required>
        <input type="text" class="form-control" name="state_delivery" placeholder="State" required>
        <input type="text" class="form-control" name="zip_delivery" placeholder="Zip Code" required>
    </div>

    <div class="form-group">
        <label for="load_info">Load Information</label>
        <input type="text" name="load_type" class="form-control" placeholder="Load Type" required>
        <input type="text" name="vehicle_size" class="form-control" placeholder="Vehicle Size" required>
        <input type="text" name="pieces" class="form-control" placeholder="Number of Pieces" required>
        <input type="text" name="load_weight" class="form-control" placeholder="Load Weight" required>
    </div>

    <div class="form-group">
        <label for="miles">Miles</label>
        <input type="text" class="form-control" name="miles" required>
    </div>

    <div class="form-group">
        <label for="budget">Price</label>
        <input type="text" class="form-control" name="budget" required>
    </div>

    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" name="note" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_load" value="Post">
    </div>
</form>