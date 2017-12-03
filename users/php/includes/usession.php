<?php
    include 'dbconfig.php';
    include 'sessionUtils.php';
    session_start();

    try{
        $user_check = $_SESSION['user_username'];
        $ses_sql = mysqli_query($db,"SELECT * FROM users WHERE username = '$user_check'");
        $row = mysqli_fetch_array($ses_sql, MYSQL_ASSOC);
        $login_user = $row['username'];

        if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_username'])){
            header("location: ../dashboard.html");
        }
    }catch (exception $e){
        echo '<script> alert("' . $e . '"");</script>';
    }