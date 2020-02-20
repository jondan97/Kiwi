<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare a select statement
    $sql = "UPDATE user SET gender = ?, referral = ? WHERE id = " . $_SESSION["id"];

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_gender, $param_referral);

        if (empty($_POST["gender"])) {
            $param_gender = "N/A";
        } else {
            $param_gender = $_POST["gender"];
        }

        if (empty($_POST["referral"])) {
            $param_referral = "N/A";
        } else {
            $param_referral = $_POST["referral"];
        }
        mysqli_stmt_execute($stmt);
    }
    else {
    }
        $_SESSION['id'] = 6;
        $sql = "INSERT INTO motive (userId, motive) VALUES (?, ?)";

if(!empty($_POST["motive1"])){
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "is", $param_userId, $param_motive);
        $param_motive = "Explore";
        $param_userId = $_SESSION['id'];
        mysqli_stmt_execute($stmt);
    }

        }

    if(!empty($_POST["motive2"])){
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "is", $param_userId, $param_motive);
            $param_motive = "Work";
            $param_userId = $_SESSION['id'];
            mysqli_stmt_execute($stmt);
        }
    }

    if(!empty($_POST["motive3"])){
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "is", $param_userId, $param_motive);
            $param_motive = "Shopping";
            $param_userId = $_SESSION['id'];
            mysqli_stmt_execute($stmt);
        }
    }

    if(!empty($_POST["motive4"])){
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "is", $param_userId, $param_motive);
            $param_motive = "Other";
            $param_userId = $_SESSION['id'];
            mysqli_stmt_execute($stmt);
        }
    }
    header("location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="assets/photos/favicon.png" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/myStyle.css">
    <script src="http://code.jquery.com/jquery-3.3.1.js"> </script>
    <script src="assets/js/typed.js"> </script>

</head>
<body class="my-pages">
    <div id="overlay">
        <div class="spinner"></div> 
    </div>

    <!-- Survey Message (animated) -->
    <div align="center" class="welcome-block">
        <table>
           <tr> 
            <td> <img class="survey-img" src="assets/photos/survey.png"/> </td>

            <td>
                <div id="typed-strings">
                    <p class="welcome-msg"> This is a quick survey, it will only take a few minutes. It really help us improve our services.</p>
                </div>
                <span id="typed"></span> <!-- JS is used for animated typing -->
            </td>
            </tr>
        </table>
    </div>

    <!-- Survey Form-->
        <div class="container-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="survey-form" method="post">
                
                <span>
                    <p> Gender </p> 
                    <input type="radio" name="gender" value="male"> Male
                    <input type="radio" name="gender" value="female"> Female
                    <input type="radio" name="gender" value="other"> Other
                </span>

                <span>
                    <p> Did someone tell you about this app? </p> 
                    <input style=";width:100%;" type="text" name="referral" >
                </span>

                <span>
                    <p>What made you download this app?</p>
                    <input type="checkbox" name="motive1" value="1"> To explore the city. <br>
                    <input type="checkbox" name="motive2" value="2"> To go to my workplace <br>
                    <input type="checkbox" name="motive3" value="3"> To go shopping <br>
                    <input type="checkbox" name="motive4" value="4"> Other <br>
                </span>
                <div align="center">
                    <button type="submit" class="survey-btn"> Submit </button>
                </div>
            </form>         
        </div>
<!-- Scripts -->
    <script src="assets/js/main.js"> </script>
</body>
</html>