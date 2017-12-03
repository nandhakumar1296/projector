<?php
	include "includes/asession.php";
	
//	$username = $_SESSION['user_username'];
	
	$date = date('Y-m-d',strtotime($_POST['date']));
	$day = $_POST['day'];
	$hour = $_POST['hour'];
	$type = $_POST['type'];

	if ($type == "projector"){

        $date_check_sql="Select COUNT(*) from projector where bookdate = '$date'";
        $date_check_result=mysqli_query($db,$date_check_sql);
        $row = mysqli_fetch_array($date_check_result);
        //$row = mysql_fetch_array($date_check_result, MYSQL_NUM);
        $row['0'];
        if($row['0'] == 1){
            $update_query = "UPDATE projector SET hour".$hour."= '' WHERE bookdate = '".$date."'";
            mysqli_query($db,$update_query);
            echo 'Successfully Unblocked';
        }else{
            echo "Unblock Failed";
        }

        /*$select_sql = "SELECT * FROM projector WHERE bookdate = '".$date."'";
        $delete_check = mysqli_query($db,$select_sql);
        $rows = mysqli_fetch_array($delete_check);
        for ($i=1; $i <=7 ; $i++) {
            if ($rows['hour$i'] == '') {
                $del =0
            }
                $delete_sql = "DELETE FROM projector WHERE bookdate = '".$date."'";
        }*/
    } else if ($type == "seminarhall"){

        $date_check_sql="Select COUNT(*) from seminarhall where bookdate = '$date'";
        $date_check_result=mysqli_query($db,$date_check_sql);
        $row = mysqli_fetch_array($date_check_result);
        //$row = mysql_fetch_array($date_check_result, MYSQL_NUM);
        $row['0'];
        if($row['0'] == 1){
            $update_query = "UPDATE seminarhall SET hour".$hour."= '' WHERE bookdate = '".$date."'";
            mysqli_query($db,$update_query);
            echo 'Successfully Unblocked';
        }else{
            echo "Unblock Failed";
        }
    }
?>