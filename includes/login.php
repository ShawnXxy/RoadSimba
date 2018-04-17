<?php 
    include "config.php"; 

    session_start();

    if (isset($_POST['login'])) {
        $login_email = mysqli_real_escape_string($con, $_POST['email']);
        $login_password = mysqli_real_escape_string($con, $_POST['password']);
        $md5_login = md5($login_password);
        $hash = password_hash($md5_login, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM $table_users WHERE email = '$login_email';";
        $query = mysqli_query($con, $sql);
        if (!$query) {
            die("Query failed : " . mysqli_error($con));
        }

        while ($row = mysqli_fetch_array($query)) {
            $user_id = $row['user_ID'];
            $email = $row['email'];
            $password = $row['password'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $role = $row['role'];           
        }

        // Check authentication
        if ($login_email === $email && password_verify($password, $hash)) {
            // Session
            $_SESSION['user_ID'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['role'] = $role;

            // Redirect
            if ($_SESSION['role'] === '0') { // Carriers
                header("Location: ../admin/dispatchers.php?source=add_dispatcher");
            } else if ($_SESSION['role'] === '1') { // Dispatchers
                header("Location: ../admin/fleets.php?source=add_fleet"); 
            } else if ($_SESSION['role'] === '2') { // Brokers
                header("Location: ../admin"); 
            } else if ($_SESSION['role'] === '3') { // Shippers
                header("Location: ../admin");
            } else {
                header("Location: ../admin"); 
                // var_dump(die($_SESSION['role']));
            }
            
            // var_dump(die($md5_login . "___________________" . $password));
            
        } else {
            // header("Location: ../index.php");
            echo "<p class='bg-warning'>Username or password is incorrect!</p>";
            // var_dump(die($md5_login . "___________________" . $password));
        }
    }
?>