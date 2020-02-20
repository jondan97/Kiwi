<?php
session_start();

require_once("config.php");

$sql = "UPDATE user SET fullname=? WHERE id=?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "si", $param_fullname,$param_id);

    // Set parameters
    $param_fullname = $_SESSION['fullname'] = $_POST['fullname'];
    $param_id = $_SESSION['id'];

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {

        header("location: profile.php");
        //Only used in case the lecturer tries to run it without mysql on
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
// Close statement
mysqli_stmt_close($stmt);
?>