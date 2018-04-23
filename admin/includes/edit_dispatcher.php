<?php
    if (isset($_GET['user_ID'])) {
        $edit_user_id = $_GET['user_ID'];
    }

    $sql = "SELECT * FROM $table_users WHERE user_ID = $edit_user_id;";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        die('Query Failed ! ' . mysqli_error($con));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        $edit_user_id = $row['user_ID'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phone = $row['phone'];
        // $role = $row['role'];
        $mc_num = $row['mc_num'];
    }

    if (isset($_POST['edit_dispatcher'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $role = $_POST['role'];                     
        $mc_num = mysqli_real_escape_string($con, $_POST['mc_num']);      

        $sql_update_dispatcher = "UPDATE $table_users SET 
            email = '$email', 
            firstname = '$firstname', 
            lastname = '$lastname', 
            phone = '$phone',
            -- role = '$role',
            mc_num = '$mc_num'
            WHERE user_ID = $edit_user_id;
            ";
        $query_update_dispatcher = mysqli_query($con, $sql_dispatcher);
        if (!$query_update_dispatcher) {
            die('Query Failed ! ' . mysqli_error($con));
        } else {
            echo "<p class='bg-success'>Updated successfully!</p>";
        }
    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname"value="<?php echo $lastname; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
    </div>

    <div class="form-group">
        <label for="mc_num">MC #</label>
        <input type="text" class="form-control" name="mc_num" value="<?php echo $mc_num; ?>">
    </div>

    <!-- <div class="form-group">
        <label for="role">Role *</label>
        <select name="role" required>
            <option value="1">Select Role</option>
            <option value="0">Carrier</option>
            <option value="1">Dispatcher</option>
            <option value="2">Broker</option>
            <option value="3">Shipper</option>
        </select>
    </div> -->

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="edit_dispatcher" value="Confirm">
    </div>
</form>