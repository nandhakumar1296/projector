<?php
include "php/includes/sessionUtils.php";
$session = new sessionUtils();
$session->checkSession($_SESSION['admin_username']);
$db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Cannot connect to database....");
$username = $_SESSION['admin_username'];
$id = $_SESSION['admin_id'];

$dateobj = date_create(); //Creating Date Object
$timestamp = date_timestamp_get($dateobj); // Getting Timestamp
$date = date("d/m/Y",$timestamp);
$dbdate=date("Y-m-d",$timestamp);
$day = date("l",$timestamp);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username;?> Seminar Hall Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">

    <script src="js/book.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="userHome.php">Online Protal</a></h1>
                </div>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="php/alogout.php" class="dropdown-toggle">Logout</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="adminHome.php"><i class="glyphicon glyphicon-home"></i>Home</a></li>
                    <li><a href="adminProjector.php"><i class="glyphicon glyphicon-list"></i>Projector</a></li>
                    <li class="current"><a href="adminSeminarHall.php"><i class="glyphicon glyphicon-list"></i>Seminar Hall</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Seminar Hall Booking</div>
                            <div class="panel-options">
                                <a href="javascript://" onclick="updatePage()" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ist Hour</th>
                                    <th>IInd Hour</th>
                                    <th>IIIrd Hour</th>
                                    <th>IVth Hour</th>
                                    <th>Vth Hour</th>
                                    <th>VIth Hour</th>
                                    <th>VIIth Hour</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($i=0; $i <30; $i++) {
                                    $dbdate =  date("Y-m-d",$timestamp);
                                    $select_sql = "SELECT * FROM seminarhall WHERE bookdate = '$dbdate'";
                                    $select_result = mysqli_query($db,$select_sql);
                                    $query_result = mysqli_fetch_array($select_result);
                                    ?>
                                    <tr>
                                        <td><font size="2"><?php echo $date; ?></font><br><?php echo $day; ?></td>
                                        <!-- Hour 1 -->
                                        <?php if ($query_result['hour1'] == ''){ ?>
                                            <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','1','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour1'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','1','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour1']; ?></td>
                                            <?php } } ?>

                                        <!-- Hour 2 -->
                                        <?php if ($query_result['hour2'] == ''){ ?>
                                            <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','2','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour2'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','2','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour2']; ?></td>
                                            <?php } } ?>

                                        <!-- Hour 3 -->
                                        <?php if ($query_result['hour3'] == ''){ ?>
                                            <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','3','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour3'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','3','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour3']; ?></td>
                                            <?php } } ?>

                                        <!-- Hour 1 -->
                                        <?php if ($query_result['hour4'] == ''){ ?>
                                            <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','4','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour4'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','4','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour4']; ?></td>
                                            <?php } } ?>

                                        <!-- Hour 1 -->
                                        <?php if ($query_result['hour5'] == ''){ ?>
                                            <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','5','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour5'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','5','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour5']; ?></td>
                                            <?php } } ?>

                                        <!-- Hour 1 -->
                                        <?php if ($query_result['hour6'] == ''){ ?>
                                            <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','6','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour6'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','6','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour6']; ?></td>
                                            <?php } } ?>

                                        <!-- Hour 1 -->
                                        <?php if ($query_result['hour7'] == ''){ ?>
                                            <td class='green' ><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','7','seminarhall')">BLOCK</a></td>
                                        <?php }else {
                                            if ($query_result['hour7'] == "Blocked"){ ?>
                                                <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','7','seminarhall')">UNBLOCK</a></td>
                                            <?php } else { ?>
                                                <td class='red'><?php echo $query_result['hour7']; ?></td>
                                            <?php } } ?>
                                    </tr>
                                    <?php
                                    $timestamp = $timestamp + 86400;
                                    $date = date("d/m/Y",+$timestamp);
                                    $day = date("l",+$timestamp);
                                    if ($day == "Sunday") {
                                        $timestamp = $timestamp + 86400;
                                        $date = date("d/m/Y",+$timestamp);
                                        $day = date("l",+$timestamp);
                                        $i=$i+1;
                                    }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="copy text-center">
                Copyright 2017 @ <a href="https://gscpsnacet.github.io" target="_blank">Google Students Club, PSNACET</a>                </div>
        </div>
    </footer>

<!--    <link href="../vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

<!--    <script src="../vendors/datatables/js/jquery.dataTables.min.js"></script>-->

<!--    <script src="../vendors/datatables/dataTables.bootstrap.js"></script>-->

    <script src="../js/custom.js"></script>
<!--    <script src="../js/tables.js"></script>-->
</body>
</html>