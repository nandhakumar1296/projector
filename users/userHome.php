<?php
    include "php/includes/sessionUtils.php";
    $session = new sessionUtils();
    $session->checkSession($_SESSION['user_username']);
    $username = $_SESSION['user_username'];
    $id = $_SESSION['user_id'];

    $dateobj = date_create(); //Creating Date Object
    $timestamp = date_timestamp_get($dateobj); // Getting Timestamp
    $date = date("d/m/Y",$timestamp);
    $dbdate=date("Y-m-d",$timestamp);
    $day = date("l",$timestamp);

    $db = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Cannot connect to database....");
    $projector_sql = "SELECT * FROM projector WHERE bookdate = '$dbdate'";
    $projector_result = mysqli_query($db,$projector_sql);
    $pquery_result = mysqli_fetch_array($projector_result);

    $seminar_sql = "SELECT * FROM seminarhall WHERE bookdate = '$dbdate'";
    $seminar_result = mysqli_query($db,$seminar_sql);
    $squery_result = mysqli_fetch_array($seminar_result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $username;?> Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="../css/styles.css" rel="stylesheet">

        <link href="../css/table.css" rel="stylesheet">

        <script src="js/book.js"></script>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
                                        <a href="php/ulogout.php" class="dropdown-toggle">Logout</a>
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
                            <li class="current"><a href="userHome.php"><i class="glyphicon glyphicon-home"></i>Home</a></li>
                            <li><a href="userProjector.php"><i class="glyphicon glyphicon-list"></i>Projector</a></li>
                            <li><a href="userSeminarHall.php"><i class="glyphicon glyphicon-list"></i>Seminar Hall</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content-box-large">
                                <div class="panel-heading">
                                    <div class="panel-title">Change password</div>
                                </div>
                                <div class="panel-body">
                                    <form method="post" action="php/changePass.php">
                                        <input class="form-control" id="currentPass" name="currentPass" type="password" placeholder="Current Password"> <br>
                                        <input class="form-control" id="newPass" name="newPass" type="password" placeholder="New Password"><br>
                                        <input class="form-control" id="reNewPass" name="reNewPass" type="password" placeholder="Re-Type New Password"><br>
                                        <div class="action">
                                            <!--<a class="btn btn-primary signup" href="dashboard.html">Login</a>-->
                                            <input type="submit" class="btn btn-primary signup" value="Change Password"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content-box-header">
                                        <div class="panel-title">Instructions</div>
                                    </div>
                                    <div class="content-box-large box-with-header">
                                        <ul>
                                            <li>Click on Book Now to Book the Projector/Seminar Hall.</li><br>
                                            <li>It is Already Booked the user who Booked it will appear on that space.</li><br>
                                            <li>After Booking you can cancel it ny clicking Cancel.</li><br>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 panel-warning">
                            <div class="content-box-header panel-heading">
                                <div class="panel-title">Today's Projector Time Table</div>

                                <div class="panel-options">
                                    <a href="javascript://" onclick="updatePage()" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                </div>
                            </div>
                            <div class="content-box-large box-with-header">
                                <div class="panel-body">
                                    <table class="table table-bordered" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">Ist Hour</th>
                                            <th style="text-align: center">IInd Hour</th>
                                            <th style="text-align: center">IIIrd Hour</th>
                                            <th style="text-align: center">IVth Hour</th>
                                            <th style="text-align: center">Vth Hour</th>
                                            <th style="text-align: center">VIth Hour</th>
                                            <th style="text-align: center">VIIth Hour</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class='time'><font size="2"><?php echo $date; ?></font><br><?php echo $day; ?></td>
                                            <!-- Hour 1 -->
                                            <?php if ($pquery_result['hour1'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','1','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour1'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','1','projector')">CANCEL</a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour1']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 2 -->
                                            <?php if ($pquery_result['hour2'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','2','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour2'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','2','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour2']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 3 -->
                                            <?php if ($pquery_result['hour3'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','3','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour3'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','3','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour3']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($pquery_result['hour4'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','4','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour4'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','4','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour4']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($pquery_result['hour5'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','5','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour5'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','5','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour5']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($pquery_result['hour6'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','6','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour6'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','6','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour6']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($pquery_result['hour7'] == ''){ ?>
                                                <td class='green' ><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','7','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($pquery_result['hour7'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','7','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $pquery_result['hour7']; ?></td>
                                                <?php } } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 panel-warning">
                            <div class="content-box-header panel-heading">
                                <div class="panel-title">Today's Seminar Hall Time Table</div>

                                <div class="panel-options">
                                    <a href="javascript://" onclick="updatePage()" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                </div>
                            </div>
                            <div class="content-box-large box-with-header">
                                <div class="panel-body">
                                    <table class="table table-bordered" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">Ist Hour</th>
                                            <th style="text-align: center">IInd Hour</th>
                                            <th style="text-align: center">IIIrd Hour</th>
                                            <th style="text-align: center">IVth Hour</th>
                                            <th style="text-align: center">Vth Hour</th>
                                            <th style="text-align: center">VIth Hour</th>
                                            <th style="text-align: center">VIIth Hour</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class='time'><font size="2"><?php echo $date; ?></font><br><?php echo $day; ?></td>
                                            <!-- Hour 1 -->
                                            <?php if ($squery_result['hour1'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','1','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour1'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','1','projector')">CANCEL</a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour1']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 2 -->
                                            <?php if ($squery_result['hour2'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','2','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour2'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','2','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour2']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 3 -->
                                            <?php if ($squery_result['hour3'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','3','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour3'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','3','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour3']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($squery_result['hour4'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','4','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour4'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','4','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour4']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($squery_result['hour5'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','5','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour5'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','5','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour5']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($squery_result['hour6'] == ''){ ?>
                                                <td class='green'><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','6','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour6'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','6','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour6']; ?></td>
                                                <?php } } ?>

                                            <!-- Hour 1 -->
                                            <?php if ($squery_result['hour7'] == ''){ ?>
                                                <td class='green' ><a href="javascript://" onClick="updateBookstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','7','projector')">BOOK NOW</a></td>
                                            <?php }else {
                                                if ($squery_result['hour7'] == $username){ ?>
                                                    <td class='orange'><a href="javascript://" onClick="updateCancelstatus('<?php echo $dbdate; ?>','<?php echo $day; ?>','7','projector')">CANCEL </a></td>
                                                <?php } else { ?>
                                                    <td class='red'><?php echo $squery_result['hour7']; ?></td>
                                                <?php } } ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/custom.js"></script>
    </body>
</html>