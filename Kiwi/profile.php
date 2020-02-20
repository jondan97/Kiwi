<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/photos/favicon.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/myStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
</head>
<?php
require_once "config.php";
$sql = "SELECT profilePic, dateRegistered FROM user WHERE id=" . $_SESSION["id"];
$image = "";
$dateRegistered = 0;
if ($result = $link->query($sql)) {
    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_row();
        $image = $row[0];
        $dateRegistered = $row[1];
    }
}
?>
<body class="my-pages">
  <div class="profile-card">
    <img src="<?php echo $image ?>" style="width:100%">
    <h1><?php echo $_SESSION["fullname"];?></h1>
    <div>
      <div><a style="font-size:18px; color:black; text-decoration:none;" href="html/nameform.html">Change Name</a></div>
      <div><a style="font-size:18px; color:black; text-decoration:none;" href="html/passwordform.html">Change Password</a></div>
      <div><a style="font-size:18px; color:black; text-decoration:none;" href="html/uploadform.html">Change Photo</a></div>
      <div><a style="font-size:18px; color:black; text-decoration:none;" href="logout.php">Log out</a></div>
        <div><a style="font-size:18px; color:black; text-decoration:none;" href="survey.php">Take this survey</a></div>
      <div>
        <p>
          You have been with us since: <?php echo $dateRegistered ?> <img src="assets/photos/heart.gif" style="height: 10%;width: 10%;">.
        </p>
      </div>
      <br>
    </div>
  </div>
  <button class=return-button onclick="window.location.href='home.php'">X</button>
  <footer>
    <p>Copyright &copy; 2019 All Rights Reserved</p>
    <a style="margin:12px;" href="#"><i class="fa fa-linkedin" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>
    <a style="margin:12px;" href="#"><i class="fa fa-twitter" style="font-size:20px; color:rgb(0, 0, 0);"></i></a>  
    <a style="margin:12px;" href="#"><i class="fa fa-facebook" style="font-size:20px; color:rgb(0, 0, 0);"></i></a> 
  </footer>
</div>        
</body>
</html>