<?php
    include "functions.php";
?>

<!-- Header -->
<?php include 'includes/header.php'; ?>



<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['firstname']; ?></small>
                    </h1>
                    <?php
                        if (isset($_SESSION['email'])) {
                            $user_ID = $_SESSION['user_ID'];
                            $sql_cur_user = "SELECT * FROM $table_users WHERE user_ID = '$user_ID';";
                            $query_cur_user = mysqli_query($con, $sql_cur_user);

                            while ($row = mysqli_fetch_array($query_cur_user)) {
                                $cur_user_id = $row['user_ID'];
                                $cur_user_lastname = $row['lastname'];
                                $cur_user_firstname = $row['firstname'];
                                $cur_user_email = $row['email'];
                                $cur_user_phone = $row['phone'];
                                $cur_user_role = $row['role'];
                            }

                            if (isset($_POST['edit_user'])) {

                                $user_firstname = mysqli_real_escape_string($con, $_POST['firstname']);
                                $user_lastname = mysqli_real_escape_string($con, $_POST['lastname']);
                                $user_email = mysqli_real_escape_string($con, $_POST['email']);
                                $user_phone = mysqli_real_escape_string($con, $_POST['phone']);
                                if ($cur_user_role == 99) {
                                    $user_role = 99;
                                } else {
                                    $user_role = $_POST['role'];
                                }
                                
                                $sql_update_user = "UPDATE $table_users SET 
                                    email = '$user_email',
                                    firstname = '$user_firstname', 
                                    lastname = '$user_lastname', 
                                    phone = '$user_phone',
                                    role = '$user_role'
                                    WHERE user_ID = $cur_user_id;
                                    ";
                                $query_update_user = mysqli_query($con, $sql_update_user);
                                if (!$query_update_user) {
                                    die('Query Failed ! ' . mysqli_error($con));
                                } else {
                                    echo "<p class='bg-success'>Updated successfully!</p>";
                                }
                            }
                        }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo $cur_user_firstname; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $cur_user_lastname; ?>" required>
                        </div>

                        <!-- <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="" required>
                        </div> -->

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $cur_user_email; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $cur_user_phone; ?>">
                        </div>

                        <div class="form-group">
                            <label for="role">Role : 
                                <?php 
                                    if ($cur_user_role == 0) {
                                        echo "Carrier";
                                    } 
                                    if ($cur_user_role == 1) {
                                        echo "Dispatcher";
                                    }
                                    if ($cur_user_role == 2) {
                                        echo "Broker";
                                    } 
                                    if ($cur_user_role == 3) {
                                        echo "Shipper";
                                    }
                                ?>
                            </label>
                            <select name="role">
                                <option value="<?php echo $cur_user_role; ?>">Select Role</option>
                                <option value="3">Shippers</option>
                                <option value="2">Broker</option>
                                <option value="1">Dispatcher</option>
                                <option value="0">Carriers</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="edit_user" value="Update">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>