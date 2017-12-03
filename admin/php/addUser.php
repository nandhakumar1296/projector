<?php
    include "includes/sessionUtils.php";
    $session = new sessionUtils();
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $staffid = $_POST['staffid'];
        $password = "psnacetit";
        $password = $session->encryptIt($password);

        $adminPass = $_POST['adminpass'];

        if ($session->checkPassword($adminPass)){
            $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Cannot connect to database....");
            $user_available = mysqli_query($db,"SELECT uid FROM users WHERE username = '$username' AND staffid = '$staffid'");
            $user_rows = mysqli_num_rows($user_available);
            if ($user_rows > 0){
                echo '<script> alert("User already exists.");</script>';
                echo '<script> window.location="../adminHome.php"; </script>';
            }else{
                $user_insert = mysqli_query($db,"   INSERT INTO users(username,Name,email,password,staffid) VALUES('$username','$name','$email','$password','$staffid')");
                if($user_insert){
                    echo '<script> alert("User sucessfully created.");</script>';
                    echo '<script> window.location="../adminHome.php"; </script>';
                }else{
                    echo '<script> alert("Error in user creation. Try again");</script>';
                    echo '<script> window.location="../adminHome.php"; </script>';
                }
            }
        }else{
            echo '<script> alert("Invalid Admin Password");</script>';
            echo '<script> window.location="../adminHome.php"; </script>';
        }
    }