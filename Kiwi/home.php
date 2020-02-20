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
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/photos/favicon.png" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="assets/css/myStyle.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/e9e9b822ba.js"></script>
    <title>Home</title>
</head>

<body>
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="map.php">Map</a></li>
                <li><a href="statistics.php">Statistics</a></li>
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

    <section class="hero">
        <div class="hero-inner noselect">
            <p style="font-size: 3em;">Kiwi</p>
            <p style="font-size: 1.5em;">eco friendly city</p>
            <button class="btn-hover color-3"> <a href="#explore"> Explore </a></button>
        </div>
    </section>
    <div class="seperator">
        <p> Rent your bicycle from any station of your choice! Enjoy cycling! </p>
    </div>
    <div class="home-content">
            <div class="row">
                <div class="col-sm-4 content-box">
                    <img style="margin-left: 40px;" src="assets/photos/content-image(backup).png">
                </div>
            <div class="col-sm-4 content-box" style="padding:50px;">
                <h2 style="margin-left: 100px;"><i style="color:#5CE47B;" class="fa fa-bicycle" aria-hidden="true"></i>&nbsp;&nbsp;Characteristics</h2>
                <p style="margin-left: 130px;"><i style="color:#5CE47B; font-size:25px;" class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;Mobile Friendly</p>
                <p style="margin-left: 150px;"><i style="color: #5CE47B;" class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Easy of Use</p>
                <p style="margin-left: 170px;"><i style="color: #5CE47B;" class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;Simple and Quick Reservations</p>
                <p style="margin-left: 190px;"><i style="color: #5CE47B;" class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;Anywhere and Anytime</p>
                <p style="margin-left: 210px;"><i style="color: #5CE47B;" class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;Prime Quality Products</p>
                <p style="margin-left: 230px;"><i style="color: #5CE47B;" class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Customized based on needs</p>
            </div>
            <div class="col-sm-4">
                    <img style="margin-left: 25px;" src="assets/photos/content-image2.png">
                </div>
        </div>
        <div class="row" id="explore">
                <div class="col-sm-6 content-box" style="background-color:#56566D;">
                    <h2 class="description-h2">#Kiwi</h2>
                    <p class="description">
                        Description Kiwi is an online reservation application, which ultimate purpose is to provide users with the flexibility of efficient city transportation by bicycles and bikes. Users can request and select any bicycle, from any station of their choice in the map. Additionally, they may view any further information related to a specific station, which can provide better accommodation, as well as assistance in their process of decision making. 
                    </p>
                </div>
            <div class="col-sm-6 content-box" style="background-color:#56566D; padding:50px;">
                    <img style="height: 300px;" src="assets/photos/content-image3.png">
            </div>
        </div>
    </div>

<footer>
    <img style="height:30px;width:30px; margin-bottom:5px;" src="assets/icons/kiwi.png"></img>
    <p>Copyright &copy; 2019 All Rights Reserved</p>
    <a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
    <a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
    <a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
</footer>
</body>

</html>