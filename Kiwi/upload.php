<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<?php
//code for uploading a file
$target_dir = "uploads/";
//set the file name as the id of the user (for uniqueness)
$target_original_name = explode(".", basename($_FILES["fileToUpload"]["name"]));
echo end($target_original_name);
$target_new_name = $_SESSION['id'] . "." . end($target_original_name);
$target_file = $target_dir . $target_new_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//also upload the file path to the database
require_once("config.php");

$sql = "UPDATE user SET profilePic = ? WHERE id=".$_SESSION['id'];

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_profilePic);

    // Set parameters
    $param_profilePic = $target_file;

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Redirect to login page
        //header("location: login.php");
    } else{
        echo "Something went wrong. Please try again later.";
    }
}

// Close statement
mysqli_stmt_close($stmt);

// Redirect user to welcome page
header("location: profile.php");

?>