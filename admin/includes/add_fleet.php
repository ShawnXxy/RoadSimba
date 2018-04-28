
<form action="" method="post" enctype="multipart/form-data">
    <!-- Add Fleet -->
    <?php add_fleet(); ?>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname">
    </div>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" class="form-control" name="email" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="">
    </div>

    <div class="form-group">
        <label for="vehicle_info">Vehicle Info</label>
        <!-- <input type="text" class="form-control" name="vehicle_id" placeholder="Vehicle Type"> -->
        <input type="text" class="form-control" name="size" placeholder="Vehicle Size">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_fleet" value="Create">
    </div>
</form>