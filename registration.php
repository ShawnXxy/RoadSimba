<?php 
    include "includes/config.php"; 

?>
    <!-- header -->
    <?php include 'includes/header.php'; ?>
    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
     
     <br/>
     <hr>
     <br/>
    <!-- Page Content -->
    <div class="container">  
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1 class="text-center">Register</h1>
                            <form action="" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['create_user'])) {
                                        $email = mysqli_real_escape_string($con, $_POST['email']);
                                        $password = mysqli_real_escape_string($con, $_POST['password']);
                                        $md5_reg = md5($password);
                                        // $hash = password_hash($md5_new, PASSWORD_DEFAULT);
                            
                                        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
                                        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
                                        $phone = mysqli_real_escape_string($con, $_POST['phone']);
                                        $role = $_POST['role'];
                                        $mc_num = mysqli_real_escape_string($con, $_POST['mc_num']);               
                                                   
                                        $sql = "INSERT INTO $table_users (
                                            email,
                                            password,
                                            firstname,
                                            lastname,
                                            phone,
                                            role,
                                            mc_num,
                                            date_registration
                                            ) VALUES (
                                                '$email', 
                                                '$md5_reg', 
                                                '$firstname', 
                                                '$lastname', 
                                                '$phone',
                                                '$role',
                                                '$mc_num',
                                                UNIX_TIMESTAMP()
                                                );";
                                        $query = mysqli_query($con, $sql);
                                        if (!$query) {
                                            die("Query failed!" . mysqli_error($con));
                                        } else {
                                            echo "<p class='bg-success'>Registered successfully! <a href='index.php#login-form'>Sign In</a></p>";
                                        }
                                        
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="email">Enter Your Email *</label>
                                    <input type="email" class="form-control" name="email" placeholder="somebody@example.com" required>
                                    <small class="form-text text-muted">Email will be used as login username.</small>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" class="form-control" name="password" minlength="8" required>
                                </div>

                                <div class="form-group">
                                    <label for="firstname">Enter Your Firstname</label>
                                    <input type="text" class="form-control" name="firstname">
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Enter Your Lastname</label>
                                    <input type="text" class="form-control" name="lastname">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="role">Role *</label>
                                    <select name="role" required>
                                        <option>Select Role</option>
                                        <option value="0">Carrier</option>
                                        <option value="1">Dispatcher</option>
                                        <option value="2">Broker</option>
                                        <option value="3">Shipper</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="mc_num">MC # </label>
                                    <input type="text" class="form-control" name="mc_num" placeholder="Input your MC# if available">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success btn-lg btn-block" id="btn-login" name="create_user" value="Sign Up">
                                </div>
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>

    <hr>

    <?php include "../includes/footer.php";?>
