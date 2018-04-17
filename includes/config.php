<?php
    /********************************
     * 
     *  Config database
     * 
     *********************************/
    DEFINE('DB_USERNAME', 'root');
    DEFINE('DB_PASSWORD', 'root');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_DATABASE', 'roadsimba');
 
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    /*****************************
     * 
     * Create table
     * 
     *********************************/
    
    $table_users = 'users';
    $table_loads = 'loads';
    $table_orders = 'orders';
    $table_vehicles = 'vehicles';
    $table_disp_carr = 'dispcarr';
    
    // USERS
    $sql = "CREATE TABLE IF NOT EXISTS $table_users (
        user_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(64) NOT NULL UNIQUE,
        password VARCHAR(64) NOT NULL,
        firstname VARCHAR(48) NOT NULL,
        lastname VARCHAR(48) NOT NULL,
        phone VARCHAR(32) NOT NULL,
        role INT(3) NOT NULL,
        mc_num VARCHAR(15) NOT NULL,
        date_registration INT(11) 
    );";
    mysqli_query($db, $sql);

    // loads
    $sql = "CREATE TABLE IF NOT EXISTS $table_loads (
        load_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        post_by_ID INT(11) NOT NULL,
        date_post INT(11) NOT NULL,
        date_exp INT(11) NOT NULL,
        date_pickup INT(11) NOT NULL, 
        date_delivery INT(11) NOT NULL, 
        addr_pickup VARCHAR(255) NOT NULL,
        city_pickup VARCHAR(11) NOT NULL,
        state_pickup VARCHAR(11) NOT NULL,
        zip_pickup VARCHAR(11) NOT NULL,
        country_pickup INT(8),
        addr_delivery VARCHAR(255) NOT NULL,
        city_delivery VARCHAR(11) NOT NULL,
        state_delivery VARCHAR(11) NOT NULL,
        zip_delivery VARCHAR(11) NOT NULL,
        country_delivery INT(8),
        load_type INT(8) NOT NULL,
        vehicle_size INT(8) NOT NULL,
        miles INT(8) NOT NULL,
        pieces INT(8) NOT NULL,
        load_weight INT(8) NOT NULL,
        budget INT(8) NOT NULL,
        note TEXT
    );";
    mysqli_query($db, $sql);

    // vehicles
    $sql = "CREATE TABLE IF NOT EXISTS $table_vehicles (
        v_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,  
        user_ID INT(11) NOT NULL,
        size INT(8) NOT NULL
    );";
    mysqli_query($db, $sql);

    // orders
    $sql = "CREATE TABLE IF NOT EXISTS $table_orders (
        order_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        load_ID INT(11) NOT NULL,
        dispatcher_ID INT(11) NOT NULL,
        carrier_ID INT(11) NOT NULL,
        price INT(11) NOT NULL,
        status INT(8) NOT NULL,
        vehicle_ID INT(11),
        note TEXT,
        date_updated INT(8) NOT NULL
    );";
    mysqli_query($db, $sql);

    // Dispatcher_carrier
    $sql = "CREATE TABLE IF NOT EXISTS $table_disp_carr (
        dc_ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        dispatcher_ID INT(11) NOT NULL,
        carrier_ID INT(11) NOT NULL
        );";
    mysqli_query($db, $sql);

    /*************************************
     * 
     *  Connect to database
     * 
     ***********************************/
    // ob_start();
    $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (!$con) {
        echo "Database connection failed!";
    }

?>