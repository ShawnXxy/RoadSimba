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
                        if (isset($_SESSION['username'])) {
                            $cur_user = $_SESSION['username'];
                            $sql_cur_user = "SELECT * FROM $table_users WHERE username = '$cur_user';";
                            $query_cur_user = mysqli_query($con, $sql_cur_user);

                            while ($row = mysqli_fetch_array($query_cur_user)) {
                                $cur_user_id = $row['user_id'];
                                $cur_username = $row['username'];
                                $cur_user_lastname = $row['user_lastname'];
                                $cur_user_firstname = $row['user_firstname'];
                                $cur_user_email = $row['user_email'];
                                $cur_user_phone = $row['user_phone'];
                                $cur_user_role = $row['user_role'];
                            }

                            if (isset($_POST['edit_user'])) {
                                $username = mysqli_real_escape_string($con, $_POST['username']);
                                $password = mysqli_real_escape_string($con, $_POST['password']);
                                $md5_edit = md5($password);
                                $hash = password_hash($md5_new, PASSWORD_DEFAULT);

                                $user_firstname = $_POST['user_firstname'];
                                $user_lastname = $_POST['user_lastname'];
                                $user_email = $_POST['user_email'];
                                $user_role = $_POST['user_role'];
                        
                                $sql_update_user = "UPDATE $table_users SET 
                                    username = '$username', 
                                    password = '$md5_edit', 
                                    user_firstname = '$user_firstname', 
                                    user_lastname = '$user_lastname', 
                                    user_email = '$user_email',
                                    user_phone = '$cur_user_phone',
                                    user_role = '$user_role'
                                    WHERE user_id = $cur_user_id;
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
                            <label for="user_firstname">Firstname</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $cur_user_firstname; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $cur_user_lastname; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $cur_username; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $cur_user_email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_email">Phone</label>
                            <input type="email" class="form-control" name="user_phone" value="<?php echo $cur_user_phone; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_role">Role : <?php echo $cur_user_role; ?></label>
                            <select name="user_role">
                                <option value="subscriber">Select Role</option>
                                <option value="Admin">Broker</option>
                                <option value="Subscriber">Dispatcher</option>
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