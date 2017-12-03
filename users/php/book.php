<?php
	include "includes/usession.php";
	
	$username = $_SESSION['user_username'];
	
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
            $update_query = "UPDATE projector SET hour".$hour."= '".$username."' WHERE bookdate = '".$date."'";
        }else{
            $update_query = "INSERT INTO projector (hour".$hour.",bookdate,bookday) values ('".$username."','".$date."','".$day."')";
        }
        mysqli_query($db,$update_query);
        echo 'Successfully updated';
    }else if ($type == "seminarhall"){

        $date_check_sql="Select COUNT(*) from seminarhall where bookdate = '$date'";
        $date_check_result=mysqli_query($db,$date_check_sql);
        $row = mysqli_fetch_array($date_check_result);
        $row['0'];
        if($row['0'] == 1){
            $update_query = "UPDATE seminarhall SET hour".$hour."= '".$username."' WHERE bookdate = '".$date."'";
        }else{
            $update_query = "INSERT INTO seminarhall (hour".$hour.",bookdate,bookday) values ('".$username."','".$date."','".$day."')";
        }
        mysqli_query($db,$update_query);
        echo 'Successfully updated';
    }
?>