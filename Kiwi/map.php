<?php
// Initialize the session
session_start();

if (!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/png" href="assets/photos/favicon.png"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/myStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e9e9b822ba.js"></script>
    <title>Map</title>
</head>
<body style="background-color:#EDEDED">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="#">Map</a></li>
            <li><a href="statistics.php">Statistics</a></li>
            <li><a href="aboutus.php">About us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
            // code for showing whether site should show signup/login OR name of user
            if ($_SESSION['loggedin'] != 1) {
                echo '
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    ';
            } elseif ($_SESSION['loggedin'] == 1) {
                echo '
                <li><a href="profile.php">Hi,&nbsp;</span>' . $_SESSION['fullname'] . '</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    ';
            }
            ?>

        </ul>
    </div>
</nav>

<div class="container">
    <img src="assets/photos/myMap(NP).png" alt="Snow">
    <button type="button" class="pointer" data-toggle="modal" data-target="#myModal1"></button>
    <button type="button" class="pointer2" data-toggle="modal" data-target="#myModal4"></button>
    <button type="button" class="pointer3" data-toggle="modal" data-target="#myModal2"></button>
    <button type="button" class="pointer4" data-toggle="modal" data-target="#myModal3"></button>
</div>

<?php
if (!empty($_SESSION['rentalCost'])) {
    echo '<script>alert("The cost is: ' . $_SESSION['rentalCost'] . '€.");</script>';
    $_SESSION['rentalCost'] = NULL;
}

if (!empty($_SESSION['bikeName'])) {
    echo '<script>alert("The name of your bike is: ' . $_SESSION['bikeName'] . '");</script>';
    $_SESSION['bikeName'] = NULL;
}
?>

<?php
//Code for capacity per station and number of available bikes
require_once "config.php";

$sql = "SELECT id,name,address,cost,capacity,picturePath FROM station";
$counter = 1;
$stationCapacity = 0;
if ($result = $link->query($sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_row()) {
            $stationId = $row[0];
            if ($_SESSION['loggedin'] != 1) {
                $button = '<form action="login.php"> <input class="rent-btn" style="float: right" type="submit" value="Login Here"></form>';
            } elseif ($_SESSION['active'] == 0) {
                $button = '<form action="rentABike.php"> <input type="hidden" name="stationId" value="' . $stationId . '"><input class="rent-btn" style="float: right" type="submit" value="Rent a Bike"></form>';
            } elseif ($_SESSION['active'] != 0) {
                $button = '<form action="returnABike.php"> <input type="hidden" name="stationId" value="' . $stationId . '"><input class="rent-btn" style="float: right" type="submit" value="Return a Bike"></form>';
            }

            $stationName = $row[1];
            $stationAddress = $row[2];
            $stationCost = $row[3];
            $stationCapacity = $row[4];
            $stationPicturePath = $row[5];
            $sql2 = "SELECT COUNT(*) from bike WHERE stationId=" . $stationId . " AND free = 1";
            $availableBikes = 0;
            if ($result2 = $link->query($sql2)) {
                if (mysqli_num_rows($result) > 0) {
                    $row2 = $result2->fetch_row();
                    $availableBikes = $row2[0];

                }

            }
            $stationFreeSlots = $stationCapacity - $availableBikes;
            $modal = '<!-- Modal -->
    <div class="modal fade" id="myModal'.$counter.'" role="dialog">
        <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">'.$stationName.'<img src="'.$stationPicturePath.'" width="100%" height="100%"></h4>
            </div>
            <div class="modal-body">
                <p class="bicycle-info"> <i class="fas fa-map-marker-alt"></i>&thinsp;'.$stationAddress.'&emsp;<i class="far fa-clock"></i>&thinsp;Always open&emsp;<i class="fas fa-tag"></i>&thinsp;'.$stationCost.'€/per hour&emsp;</p><br>
                <h3 id="available bikes" class="available-bikes"> <i class="fas fa-bicycle"></i> Available bikes: '.$availableBikes.

                $button .
                '<h3 class="available-bikes"> <i class="fas fa-parking"></i> Free slots: '. $stationFreeSlots.'</h3>
            </div>
            <div class="modal-footer" style="font-family:Segoe UI;">
                <button  class="close-btn" data-dismiss="modal">Close</button>
            </div>
            </div>
            
        </div>
        </div>';
            echo $modal;

            //echo "Station ID: " . $stationId . ", Capacity: " . $stationCapacity . ", Available Bikes: " . $availableBikes . "<br>";
            $counter++;
        }
        $result->close();
        $result2->close();
    } else {
        echo "Something went wrong with the number of rows in the DB.";
    }
} else {
    echo "Something went wrong with the DB.";
}
//$link->close(); uncomment this after usage of db has ended
?>

<footer>
    <img style="height:30px;width:30px; margin-bottom:5px;" src="assets/icons/kiwi.png"></img>
<p>Copyright &copy; 2019 All Rights Reserved</p>
<a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
<a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
<a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
</footer>

</body>
</html>