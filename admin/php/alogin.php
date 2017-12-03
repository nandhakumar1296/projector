<?php
    session_start();
    include "includes/dbconfig.php";
    include "includes/sessionUtils.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $session = new sessionUtils();
        $username = $_POST["Username"];
        $password = $_POST["Password"];
        $password = $session->encryptIt($password);
        $login_err = "";

        $login_query = mysqli_query($db, "SELECT * FROM admins WHERE username = '$username' and password = '$password'");
        $login_result = mysqli_num_rows($login_query);
        $login_array = mysqli_fetch_array($login_query, MYSQL_ASSOC);

        if ($login_query){
            if ($login_result == 1){
                $session->UserLogin($login_array['aid'],$login_array['username']);
                header("location: ../adminHome.php");
            }else{
                echo '<script> alert("Invalid credentials");</script>';
                echo '<script> window.location="../adminLogin.html"; </script>';
            }
        }else{
            echo '<script> alert("Login Error. Please Try Again.");</script>';
            echo '<script> window.location="../adminLogin.html"; </script>';
        }
    }