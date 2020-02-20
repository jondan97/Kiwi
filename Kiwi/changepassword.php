<?php
session_start();
require_once("config.php");
$sql = "SELECT id, password FROM user WHERE id = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_id);

    // Set parameters
    $param_id = $_SESSION['id'];
    $password = $_POST['oldpassword'];

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id,  $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, so do stuff
                    $sql = "UPDATE user SET password=? WHERE id=?";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "si", $param_password,$param_id);

                        // Set parameters
                        $param_password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT); // Creates a password hash;
                        $param_id = $_SESSION['id'];

                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {

                            header("location: profile.php");
                            //Only used in case the lecturer tries to run it without mysql on
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }

                }
                else {
                    echo "Passwords did not match.";
                }
            }

        //Only used in case the lecturer tries to run it without mysql on
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
// Close statement
mysqli_stmt_close($stmt);
?>