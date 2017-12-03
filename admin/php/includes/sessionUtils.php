<?php

    class sessionUtils{

        function __construct(){
            if (session_status() == PHP_SESSION_NONE){
                session_start();
                include "dbconfig.php";
            }
        }

        public function UserLogin($id,$username){
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $username;
        }

        public function Logout(){
            session_destroy();
            return true;
        }

        function encryptIt( $q ) {
            $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
            $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
            return( $qEncoded );
        }

        function decryptIt( $q ) {
            $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
            $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
            return( $qDecoded );
        }

        function checkSession($userChk){
            $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Cannot connect to database....");
            try{
                $ses_sql = mysqli_query($db,"SELECT * FROM admins WHERE username = '$userChk'");
                $row = mysqli_fetch_array($ses_sql, MYSQL_ASSOC);
                $username = $row['username'];

                if (!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_username'])){
                    header("location: adminLogin.html");
                }
            }catch (exception $e){
                echo '<script> alert("' . $e . '"");</script>';
            }
        }

        function checkPassword($password){
            $username = $_SESSION['admin_username'];
            $password = $this->encryptIt($password);
            $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Cannot connect to database....");

            try{
                $pass_sql = mysqli_query($db,"SELECT * FROM admins WHERE username = '$username' AND password = '$password'");
                $pass_result = mysqli_num_rows($pass_sql);
                $row = mysqli_fetch_array($pass_sql, MYSQL_ASSOC);

                if ($pass_sql){
                    if ($pass_result == 1){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }catch (exception $e){
                echo '<script> alert("' . $e . '"");</script>';
            }
        }
    }