
<form action="" method="post" enctype="multipart/form-data">
    <!-- Update location -->
    <?php update_truck_loc(); ?>
    <div class="form-group">
        <label for="truck_time">Date *</label>
        <input class="form-control" type="text" name="truck_time" placeholder="YYYY-MM-DD hh:mm" required>
    </div>
    <div class="form-group">
        <label for="truck_loc">Location</label>
        <input class="form-control" type="text" name="truck_city" placeholder="City">
        <input class="form-control" type="text" name="truck_state" placeholder="State">
        <small>Or</small>
        <input class="form-control" type="text" name="truck_zip" placeholder="Zip code">
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="update" value="Update Location">
    </div>                          
</form>

