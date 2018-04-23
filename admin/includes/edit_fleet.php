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
        $role = $row['role'];
    }

    if (isset($_POST['edit_fleet'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);

        $vehicle_size = mysqli_real_escape_string($con, $_POST['size']);

        $sql_update_fleet = "UPDATE $table_users SET
            email = '$email',
            firstname = '$firstname',
            lastname = '$lastname',
            phone = '$phone'
            WHERE user_ID = $edit_user_id;
            ";
        $query_update_fleet = mysqli_query($con, $sql_update_fleet);
        if (!$query_update_user) {
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
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
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
        <input type="submit" class="btn btn-success" name="edit_fleet" value="Confirm">
    </div>
</form>
