<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, fullname, rentalId FROM user WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $fullname, $active);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["fullname"] = $fullname;
            if ($active == NULL) {
                $_SESSION["active"] = 0; // is not active
            } else {
                $_SESSION["active"] = $active; //is active, saved to a global variable that can be accessed in any page
                //provided there's a session_start() at the beggining of all pages (before html)
                //https://www.w3schools.com/php/php_sessions.asp
            }
 
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
                //Only used in case the lecturer tries to run it without mysql on
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/myStyle.css">
    <script src="assets/js/TASandRC.js"></script>
</head>

<body class="my-pages">
<div id="overlay">
    <div class="spinner"></div>
</div>
<!-- Login Form window -->
<div class="container-center">
    <div class="login-form">
        <div class="tabs">
            <button class="login-btn"> Login</button>
            <a href="register.php">
                <button class="register-btn" style="color:rgba(0,0,0,0.2);"> Register</button>
            </a>
        </div>
        <!-- PHP Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" class="text-input"
                       value="<?php echo $username; ?>">
            </div>
            <span class="help-block"><?php echo $username_err; ?></span>
            <br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder="Password" class="text-input">
            </div>
            <span class="help-block"><?php echo $password_err; ?></span>
            <br>
            <!-- Checkbox -->
            <input type="checkbox" name="checkbox" value="medium" id="rememberPC"/>
            <label for="checkbox">Remember this computer</label>
            <br>
            <button type="submit" class="submit-btn"> ›</button>
        </form>
    </div>
</div>
</body>
<!-- Scripts -->
<script src="assets/js/main.js"></script>
</html>