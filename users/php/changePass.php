<?php
    include "includes/sessionUtils.php";
    $session = new sessionUtils();
    $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Cannot connect to database....");

    $username = $_SESSION['user_username'];
    $id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $current = $_POST['currentPass'];
        $new = $_POST['newPass'];
        $repass = $_POST['reNewPass'];

        $password = $session->encryptIt($current);

        $pass_check_sql = mysqli_query($db,"SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $pass_check_array = mysqli_fetch_array($pass_check_sql);

        if ($pass_check_array['password'] == $password){
            if ($new == $repass){
                $new = $session->encryptIt($new);
                $repass_sql = "UPDATE users SET password = '$new' WHERE uid = '$id' AND username = '$username'";
                if (mysqli_query($db,$repass_sql)){
                    echo '<script> alert("Password Changed Successfully");</script>';
                    echo '<script> window.location="../userHome.php"; </script>';
                }else{
                    echo '<script> alert("Password is not changed. Try again");</script>';
                    echo '<script> window.location="../userHome.php"; </script>';
                }
            }else{
                echo '<script> alert("Password does not match.");</script>';
                echo '<script> window.location="../userHome.php"; </script>';
            }
        }else{
            echo '<script> alert("Current Password is wrong.");</script>';
            echo '<script> window.location="../userHome.php"; </script>';
        }
    }