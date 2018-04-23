<?php
    /******************
     *
     * Loads
     *
     ********************/
    function view_loads() {
        global $con;
        global $table_loads;
        global $table_users;

        // Showing all loads to Dispatchers
        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
            $sql = "SELECT * FROM $table_loads ORDER BY date_post DESC;";
            $query = mysqli_query($con, $sql);
        }

        // Showing only loads to Brokers/Shippers posted
        if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
            $cur_user_ID = $_SESSION['user_ID'];
            $sql = "SELECT * FROM $table_loads WHERE post_by_ID = $cur_user_ID ORDER BY date_post DESC;";
            $query = mysqli_query($con, $sql);
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $load_id = $row['load_ID'];
            $post_by_id = $row['post_by_ID'];
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

            echo "<tr>";
            echo "<td>$load_id</td>";

            $sql_u = "SELECT * FROM $table_users WHERE user_ID = $post_by_id;";
            $query_u = mysqli_query($con, $sql_u);
            while ($row = mysqli_fetch_assoc($query_u)) {
                $post_by = $row['firstname'] . " " . $row['lastname'] . " / " . $row['email'];
                echo "<td>$post_by</td>";
            }

            echo "<td>$date_post" . " - " . "$date_exp</td>";
            echo "<td>$date_pickup" . " - " . "$date_delivery</td>";
            echo "<td>$addr_pickup" . ", " . "$city_pickup" . ", " . "$state_pickup" . " " . "$zip_pickup</td>";
            echo "<td>$addr_delivery" . ", " . "$city_delivery" . ", " . "$state_delivery" . " " . "$zip_delivery</td>";
            echo "<td>$load_type" . " / " . "$vehicle_size</td>";
            echo "<td>$miles</td>";
            echo "<td>$pieces" . " / " . "$load_weight</td>";
            echo "<td>$budget</td>";
            echo "<td>$note</td>";
            echo "
                <td>
                    <a href='loads.php?source=edit_load&load_ID=$load_id' class='btn btn-primary'>Edit</a>
                    <a href='loads.php?delete=$load_id' class='btn btn-danger'>Delete</a>
                </td>
                ";
            echo "</tr>";
        }
    }

    function insert_load() {
        global $con;
        global $table_loads;

        if (isset($_POST['create_load'])) {
            $post_by = $_SESSION['user_ID'];
            $date_exp = strtotime(mysqli_real_escape_string($con, $_POST['date_exp']));

            $date_pickup = strtotime(mysqli_real_escape_string($con, $_POST['date_pickup']));
            $date_delivery = strtotime(mysqli_real_escape_string($con, $_POST['date_delivery']));

            $addr_pickup = mysqli_real_escape_string($con, $_POST['addr_pickup']);
            $city_pickup = mysqli_real_escape_string($con, $_POST['city_pickup']);
            $state_pickup = mysqli_real_escape_string($con, $_POST['state_pickup']);
            $zip_pickup = mysqli_real_escape_string($con, $_POST['zip_pickup']);

            $addr_delivery = mysqli_real_escape_string($con, $_POST['addr_delivery']);
            $city_delivery = mysqli_real_escape_string($con, $_POST['city_delivery']);
            $state_delivery = mysqli_real_escape_string($con, $_POST['state_delivery']);
            $zip_delivery = mysqli_real_escape_string($con, $_POST['zip_delivery']);

            $load_type = mysqli_real_escape_string($con, $_POST['load_type']);
            $vehicle_size = mysqli_real_escape_string($con, $_POST['vehicle_size']);
            $miles = mysqli_real_escape_string($con, $_POST['miles']);
            $pieces = mysqli_real_escape_string($con, $_POST['pieces']);
            $load_weight = mysqli_real_escape_string($con, $_POST['load_weight']);
            $budget = mysqli_real_escape_string($con, $_POST['budget']);

            $note = mysqli_real_escape_string($con, $_POST['note']);

            $sql = "INSERT INTO $table_loads (
                post_by_ID,
                date_post,
                date_exp,
                date_pickup,
                date_delivery,
                addr_pickup,
                city_pickup,
                state_pickup,
                zip_pickup,
                addr_delivery,
                city_delivery,
                state_delivery,
                zip_delivery,
                load_type,
                vehicle_size,
                miles,
                pieces,
                load_weight,
                budget,
                note
                ) VALUES (
                    '$post_by',
                    ".time().",
                    '$date_exp',
                    '$date_pickup',
                    '$date_delivery',
                    '$addr_pickup',
                    '$city_pickup',
                    '$state_pickup',
                    '$zip_pickup',
                    '$addr_delivery',
                    '$city_delivery',
                    '$state_delivery',
                    '$zip_delivery',
                    '$load_type',
                    '$vehicle_size',
                    '$miles',
                    '$pieces',
                    '$load_weight',
                    '$budget',
                    '$note'
                    );";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed!" . mysqli_error($con));
            } else {
                echo "<p class='bg-success'>Load posted successfully! <a href='loads.php'>View Orders</a></p>";
            }

        }
    }

    function delete_load() {
        global $con;
        global $table_loads;

        if (isset($_GET['delete'])) {
            $delete_load_id = $_GET['delete'];
            $sql = "DELETE FROM $table_loads WHERE load_ID = $delete_load_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: loads.php");
            }
        }
    }


    /******************
     *
     * Fleets
     *
     ********************/
    function load_fleets() {
        global $con;
        global $table_users;
        global $table_vehicles;
        global $table_disp_carr;

        $cur_user_ID = $_SESSION['user_ID'];
        $sql = "SELECT * FROM $table_users JOIN $table_disp_carr ON carrier_ID = $table_users.user_ID WHERE  role = 0 AND dispatcher_ID = $cur_user_ID;";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $user_id = $row['user_ID'];
            $email = $row['email'];
            $lastname = $row['lastname'];
            $firstname = $row['firstname'];
            $role = $row['role'];
            $phone = $row['phone'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$lastname</td>";
            echo "<td>$firstname</td>";
            echo "<td>$email</td>";
            echo "<td>$phone</td>";

            $sql_v = "SELECT * FROM $table_vehicles WHERE user_ID = $user_id;";
            $query_v = mysqli_query($con, $sql_v);
            while ($row_v = mysqli_fetch_assoc($query_v)) {
                $v_id = $row_v['v_ID'];
                $v_size = $row_v['size'];
                echo "<td>$v_id" . " / " . "$v_size</td>";
            }

            echo "
                <td>
                    <a href='fleets.php?source=edit_fleet&user_ID=$user_id' class='btn btn-primary'>Edit</a>
                    <a href='fleets.php?delete=$user_id' class='btn btn-danger'>Delete</a>
                </td>
                ";
            echo "</tr>";
        }
    }

    function add_fleet() {
        global $con;
        global $table_users;
        global $table_vehicles;
        global $table_disp_carr;

        if (isset($_POST['create_fleet'])) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);

            $vehicle_size = mysqli_real_escape_string($con, $_POST['size']);

            // Store carriers/fleet into users table
            $sql_u = "INSERT INTO $table_users (
                email,
                firstname,
                lastname,
                phone,
                role
                ) VALUES (
                    '$email',
                    '$firstname',
                    '$lastname',
                    '$phone',
                    0
                    );";
            $query_u = mysqli_query($con, $sql_u);

            $carrier_ID = mysqli_insert_id($con);

            // Store info into vehicles table
            $sql_v = "INSERT INTO $table_vehicles (
                user_ID,
                size
                ) VALUES (
                    $carrier_ID,
                    $vehicle_size
                    );";
            $query_v = mysqli_query($con, $sql_v);

            // Store info into dispcarr table
            $dispatcher_ID = $_SESSION['user_ID'];
            $sql_dc = "INSERT INTO $table_disp_carr (
                dispatcher_ID,
                carrier_ID
                ) VALUES (
                    $dispatcher_ID,
                    $carrier_ID
                    );";
            $query_dc = mysqli_query($con, $sql_dc);

            if (!$query_u || !$query_v || !$query_dc) {
                die("Query failed!" . mysqli_error($con));
            } else {
                echo "<p class='bg-success'>Added successfully! <a href='fleets.php'>View Fleets</a></p>";
            }

        }
    }

    function delete_fleet() {
        global $con;
        global $table_users;

        if (isset($_GET['delete'])) {
            $delete_user_id = $_GET['delete'];
            $sql = "DELETE FROM $table_users WHERE user_ID = $delete_user_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: fleets.php");
            }
        }
    }

/******************
     *
     * DISPATCHERS
     *
     ********************/

    function add_dispatcher() {
        global $con;
        global $table_users;

        if (isset($_POST['create_dispatcher'])) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            // $role = $_POST['role'];
            $mc_num = mysqli_real_escape_string($con, $_POST['mc_num']);

            $sql = "INSERT INTO $table_users (
                email,
                firstname,
                lastname,
                phone,
                role,
                mc_num
                ) VALUES (
                    '$email',
                    '$firstname',
                    '$lastname',
                    '$phone',
                    1,
                    '$mc_num'
                    );";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed!" . mysqli_error($con));
            } else {
                echo "<p class='bg-success'>Added successfully! <a href='dispatchers.php'>View Dispatchers</a></p>";
            }

        }
    }

    function load_dispatchers() {
        global $con;
        global $table_users;

        $sql = "SELECT * FROM $table_users where role = 1;";
        $query = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($query)) {
            $user_id = $row['user_ID'];
            $email = $row['email'];
            $lastname = $row['lastname'];
            $firstname = $row['firstname'];
            $role = $row['role'];
            $phone = $row['phone'];
            $mc_num = $row['mc_num'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$lastname</td>";
            echo "<td>$firstname</td>";
            echo "<td>$email</td>";
            echo "<td>$phone</td>";
            echo "<td>$role</td>";
            echo "<td>$mc_num</td>";


            echo "
                <td>
                    <a href='dispatchers.php?source=edit_dispatcher&user_ID=$user_id' class='btn btn-primary'>Edit</a>
                    <a href='dispatchers.php?delete=$user_id' class='btn btn-danger'>Delete</a>
                </td>
                ";
            echo "</tr>";
        }
    }

    function delete_dispatcher() {
        global $con;
        global $table_users;

        if (isset($_GET['delete'])) {
            $delete_user_id = $_GET['delete'];
            $sql = "DELETE FROM $table_users WHERE user_ID = $delete_user_id;";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed ! " . mysqli_error($con));
            } else {
                header("Location: dispatchers.php");
            }
        }
    }

?>
