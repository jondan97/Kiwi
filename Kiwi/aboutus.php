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
    <title>About Us</title>
</head>

<body class="my-pages">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="map.php">Map</a></li>
            <li><a href="statistics.php">Statistics</a></li>
            <li><a href="#">About us</a></li>
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

<div class="aboutus-text">
    <h3><center>Background<center></h3>
    <p style="padding:5px 100px 15px 100px; text-align: justify; font-size:18px ">
        This web application project was a group work assignment for the Web Application course, as part of our Computer Science program. It was made possible by the support and thoughtful contributions of the team consisting of the following students: Ioannis Daniil, Dimitris Evangelou, Christos Dileris, and Michael-Angelos Damalas. Each student had to partake in several individual tasks. Briefly, it includes the following work:
    </p>
</div>
<div class="row is-collapsible">
    <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-3 info-box">
        <div class="aboutus-card">
            <br>
            <div class="circle">
                <img src="assets/photos/portrait1.png">
            </div>
            <h1>Dimitris Evangelou</h1>
            <hr>
            <div style="margin: 24px 0;">
                <div><p class="aboutus-info">Front-End Developer</p></div>
                <div><p class="aboutus-info">Athens Tech Undergraduate Student</p></div>
                <div style="margin:14px;" >
                    <a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-3 info-box">
        <div class="aboutus-card">
            <br>
            <div class="circle">
                <img src="assets/photos/portrait2.png">
            </div>
            <h1>Ioannis Daniil</h1>
            <hr>
            <div style="margin: 24px 0;">
                <div><p class="aboutus-info">Back-End Developer</p></div>
                <div><p class="aboutus-info">Athens Tech Undergraduate Student</p></div>
                <div style="margin:14px;" >
                    <a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-3 info-box">
        <div class="aboutus-card">
            <br>
            <div class="circle">
                <img src="assets/photos/portrait3.png">
            </div>
            <h1>Michail Damalas</h1>
            <hr>
            <div style="margin: 24px 0;">
                <div><p class="aboutus-info">Website Content/Utilities</p></div>
                <div><p class="aboutus-info">Athens Tech Undergraduate Student</p></div>
                <div style="margin:14px;" >
                    <a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-3 info-box">
        <div class="aboutus-card">
            <br>
            <div class="circle">
                <img src="assets/photos/portrait4.png">
            </div>
            <h1>Christos Dileris</h1>
            <hr>
            <div style="margin: 24px 0;">
                <div><p class="aboutus-info">Design/Utilities</p></div>
                <div><p class="aboutus-info">Athens Tech Undergraduate Student</p></div>
                <div style="margin:14px;" >
                    <a style="margin:12px;" href="#"><i class="fab fa-linkedin-in" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-twitter" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                    <a style="margin:12px;" href="#"><i class="fab fa-facebook-f" style="font-size:30px; color:rgb(0, 0, 0);"></i></a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="aboutus-text">
    <p style="padding:35px 100px 15px 100px; text-align: justify; font-size:18px ">
        Alongside this work, each student was also responsible for the design, development and integration of other small, but not less important website elements/functionalities useful yet engaging for the overall project.
    </p>
</div>
<div class="aboutus-text">
    <h3><center>Future Thoughts<center></h3>
    <p style="padding:5px 100px 55px 100px; text-align: justify; font-size:18px ">
        Kiwi, as an online bicycle reservation application, was initially developed to fulfill the demanding requirements of a coursework assignment. However, this very student assignment may have set the foundations for greater and more professional works. The finalization and completion of this work may have triggered a span of personal inspiration and engagement for new and improved ideas, for future website applications.
    </p>
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
