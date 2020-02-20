<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $fullname = "";
$username_err = $password_err = $confirm_password_err = $email_err = $fullname_err = "";
$emailNot = 0;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else if (empty(trim($_POST["fullname"]))) {
        $fullname_err = "Please enter a full name.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    //Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (strpos(trim($_POST["email"]), '@') == false or strpos(trim($_POST["email"]), '.') == false) {
        $email_err = "Please enter a proper email.";
    } else {
        $email = trim($_POST["email"]);
    }

    //Validate fullname
    if (empty(trim($_POST["fullname"]))) {
        $fullname_err = "Please enter a full name.";
    } else {
        $fullname = trim($_POST["fullname"]);
    }

    //Validate email Notifications
    if (empty(trim($_POST["emailNotifications"]))){
        $emailNot = "0";
    }
    else {
        $emailNot = "1";
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err && empty($email_err) && empty($fullnameu))) {

        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, fullname, email, dateRegistered, emailNotifications) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_fullname, $param_email, $param_date, $param_emailNot);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fullname = $fullname;
            $param_email = $email;
            $param_date = date("Y-m-d");
            $param_emailNot = $emailNot;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to survey page
                header("location: survey.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="assets/photos/favicon.png"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/myStyle.css">
</head>

<body class="my-pages">
<div id="overlay">
    <div class="spinner"></div>
</div>
<!-- Register Form window -->
<div class="container-center">
    <div class="register-form">
        <div class="tabs">
            <a href="login.php">
                <button class="login-btn" style="color:rgba(0,0,0,0.2);"> Login</button>
            </a>
            <button class="register-btn"> Register</button>
        </div>
        <!-- PHP Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="fullname" placeholder="Full Name" class="text-input"
                       value="<?php echo $fullname; ?>">
            </div>
            <span class="help-block"><?php echo $fullname_err; ?></span>
            <br>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" placeholder="Email" class="text-input" value="<?php echo $email; ?>">
            </div>
            <span class="help-block"><?php echo $email_err; ?></span>
            <br>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" class="text-input"
                       value="<?php echo $username; ?>">
            </div>
            <span class="help-block"><?php echo $username_err; ?></span>
            <br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder="Password" class="text-input"
                       value="<?php echo $password; ?>">
            </div>
            <span class="help-block"><?php echo $password_err; ?></span>
            <br>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="text-input"
                       value="<?php echo $confirm_password; ?>">
            </div>
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
            <br>
            <!-- Checkbox -->
            <input type="checkbox" name="checkbox" value="medium"/> <label for="checkbox">I accept the Terms and
                Conditions</label></label>
            <br>
            <input type="checkbox" name="emailNotifications" value="1"/>
            <label for="emailNotifications">I want to receive email notifications</label>
            <br>
            <button type="submit" class="submit-btn" id="submit-btn"> ›</button>
            <!-- TODO: footer hides the submit button (without the following <br>) -->
        </form>
        <!-- Button to test survey.html page -->
        <!-- <a href="survey.html"> <button type="submit"> survey </button> </a> -->
    </div>
</div>
<!-- Scripts -->
<script src="assets/js/main.js"></script>
</body>
</html>
