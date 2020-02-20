<?php
// Initialize the session
session_start();

if(!isset($_SESSION['loggedin'])){
    $_SESSION['loggedin'] = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Statistics</title>
    <script src="https://kit.fontawesome.com/e9e9b822ba.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

        @keyframes bake-pie {
            from {
                transform: rotate(0deg) translate3d(0, 0, 0);
            }
        }

        body {
            font-family: "Open Sans", Arial;
            background: #5CE47B;
        }

        main {
            width: 400px;
            margin: 30px auto;
        }

        section {
            margin-top: 30px;
        }

        .pieID {
            display: inline-block;
            vertical-align: top;
        }

        .pie {
            height: 240px;
            width: 240px;
            position: relative;
            margin: 0 2px 2px 0;
        }

        .pie::before {
            content: "";
            display: block;
            position: absolute;
            z-index: 1;
            width: 100px;
            height: 100px;
            background: #EEE;
            border-radius: 50%;
            top: 50px;
            left: 50px;
        }

        .pie::after {
            content: "";
            display: block;
            width: 120px;
            height: 2px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            box-shadow: 0 0 3px 4px rgba(0, 0, 0, 0.1);
            margin: 220px auto;
        }

        .slice {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
            animation: bake-pie 1s;
        }

        .slice span {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            background-color: black;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            clip: rect(0px, 200px, 200px, 100px);
        }

        .legend {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background: #FFF;
            padding: 15px;
            font-size: 13px;
            box-shadow: 1px 1px 0 #DDD, 2px 2px 0 #BBB;
        }

        .legend li {
            width: 110px;
            height: 1.25em;
            margin-bottom: 0.7em;
            padding-left: 0.5em;
            border-left: 1.25em solid black;
        }

        .legend em {
            font-style: normal;
        }

        .legend span {
            float: right;
        }

        footer {
            position: fixed;
            bottom: 0;
            right: 0;
            font-size: 13px;
            background: #DDD;
            padding: 5px 10px;
            margin: 5px;
        }

        .my-table {
            background-color: #BBBBBB;
        }

        .my-table td, .my-table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body class="my-pages">
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="map.php">Map</a></li>
                <li><a href="#">Statistics</a></li>
                <li><a href="aboutus.php">About us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                // code for showing whether site should show signup/login OR name of user
                if ($_SESSION['loggedin'] != 1){
                    echo '
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    ';
                }
                elseif ($_SESSION['loggedin'] == 1){
                    echo '
                <li><a href="profile.php">Hi,&nbsp;</span>' . $_SESSION['fullname']. '</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    ';
                }
                ?>

            </ul>
        </div>
    </nav>
<?php
//code for graph
require_once "config.php";

$sql = "SELECT COUNT(*) FROM motive WHERE motive='Work'";
$work = 0;
if ($result = $link->query($sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_row();
        $work = $row[0];
    }
}
$sql = "SELECT COUNT(*) FROM motive WHERE motive='Explore'";
$explore = 0;
if ($result = $link->query($sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_row();
        $explore = $row[0];
    }
}
$sql = "SELECT COUNT(*) FROM motive WHERE motive='Shopping'";
$shopping = 0;
if ($result = $link->query($sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_row();
        $shopping = $row[0];
    }
}
$sql = "SELECT COUNT(*) FROM motive WHERE motive='N/A' OR motive='Other'";
$other = 0;
if ($result = $link->query($sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_row();
        $other = $row[0];
    }
}

?>

<main>
    <section>
        <div class="pieID pie">

        </div>
        <ul class="pieID legend">
            <li>
                <em>Explore City</em>
                <span><?php echo $explore ?></span>
            </li>
            <li>
                <em>Go to work</em>
                <span><?php echo $work ?></span>
            </li>
            <li>
                <em>Go shopping</em>
                <span><?php echo $shopping ?></span>
            </li>
            <li>
                <em>Other</em>
                <span><?php echo $other ?></span>
            </li>
        </ul>
    </section>
</main>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="assets/js/index.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<table class="my-table">

    <?php

    ?>

    <?php

    function turnTimeIntoString($time){
        $totalSeconds = $time;
        $totalTimeStr = "";
        $currentSecond = $totalSeconds % 60;
        $totalMinutes = $totalSeconds / 60;
        $currentMinute = $totalMinutes % 60;
        $currentHour = $totalMinutes / 60;
        if ($currentSecond != 0) {
            $totalTimeStr = $currentSecond . "s";
        }
        if ($currentMinute != 0) {
            $totalTimeStr = $currentMinute . "m " . $totalTimeStr;
        }
        if ($currentHour != 0) {
            $totalTimeStr = (int)$currentHour . "h " . $totalTimeStr;
        }
        return $totalTimeStr;
    }
    //Code for showing timeSum, costSum and user history
    require_once "config.php";


    if ($_SESSION['loggedin'] == 1) {
        $sql = "SELECT timeSum, costSum FROM user WHERE id=".$_SESSION['id'];
        $timeSum = 0;
        $costSum = 0;
        if ($result = $link->query($sql)) {
            if (mysqli_num_rows($result) > 0) {
                $row = $result->fetch_row();
                $timeSum = $row[0];
                $costSum = $row[1];
            }
        }
        $timeStr = turnTimeIntoString($timeSum);

        echo '<div class="history-info"> Total Time Spent: ' .$timeStr.'</div>';
        echo '<div class="history-info"> Total Cost Spent: '.$costSum.'€</div>';

        ?>
    <script>
        $(document).ready(function() {
            $('#history').DataTable( {
                "pagingType": "full_numbers"
            } );
        } );
    </script>
    <?php

        $firstRow = "<table id=\"history\" class=\"display\" style=\"width:100%\"><thead><tr> <th>Bike Name <th>Time <th> Cost <th> Date Rented <th> Date Returned <th> Station From <th> Station To</thead>";
        echo $firstRow;

        $sql = "SELECT b.name, r.cost, r.dateRented, r.dateReturned, s1.name, s2.name FROM rental r JOIN station s1 ON s1.id=r.stationIdFrom JOIN station s2 ON s2.id=r.stationIdTo JOIN bike b ON b.id=r.bikeId WHERE r.userId=" . $_SESSION["id"] . " ORDER BY r.dateRented DESC";
        if ($result = $link->query($sql)) {
            if (mysqli_num_rows($result) > 0) {
                $counter = 1; //for each modal in the website: if counter=1 then use modal 1 elseif etc...
                echo "<tbody>";
                while ($row = $result->fetch_row()) {
                    $bikeName = $row[0];
                    $cost = $row[1];
                    $dateRented = $row[2];
                    $dateReturned = $row[3];
                    $stationRented = $row[4];
                    $stationReturned = $row[5];
                    $dateRentedTimestamp = strtotime($dateRented);
                    $dateRented = date('d M Y', $dateRentedTimestamp);
                    $dateReturnedTimestamp = strtotime($dateReturned);
                    $dateReturned = date('d M Y', $dateReturnedTimestamp);
                    $time = $dateReturnedTimestamp - $dateRentedTimestamp;

                    $timeStr = turnTimeIntoString($time);


                    echo "<tr><td>" . $bikeName . "<td>" . $timeStr . "<td>" . $cost . "€<td>" . $dateRented . "<td>" . $dateReturned . "<td>" . $stationRented . "<td>" . $stationReturned . "<br>";
                    $counter++;
                }
                echo "</tbody>";
                $result->close();
                echo "</table>";
            } else {
                echo "<tr><td colspan=\"7\">You have no history";
                echo "</table>";
            }
        } else {
            echo "Something went wrong with the DB.";
        }
    }
    else {
        $firstRow = "<tr> <td>Bike Name <td>Time <td> Cost <td> Date Rented <td> Date Returned <td> Station From <td> Station To";
        echo $firstRow;
        echo "<tr><td colspan=\"7\">Please login to show your history</table>";
    }
    ?>

<footer style="background-color:#333333; margin-bottom:0px; margin-right:0px;">
    <img style="height:30px;width:30px; margin-bottom:5px;" src="assets/icons/kiwi.png"></img>
    <p>Copyright &copy; 2019 All Rights Reserved</p>
    <a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
    <a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
    <a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
</footer>
</body>

</html>
