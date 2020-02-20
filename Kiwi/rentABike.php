<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//checks for intruders
if (isset($_SESSION["active"]) and $_SESSION["active"] != 0) {
    header("location: map.php");
    exit;
}

require_once "config.php";

//in case some intruder wants to parse his own string
if (is_numeric($_GET["stationId"]) == "integer") {
    //checking for number of available bikes
    $sql = "SELECT COUNT(*) from bike WHERE stationId=" . $_GET["stationId"] . " AND free = 1";
    if ($result = $link->query($sql)) {
        //if the number of available bikes is not 0 on this station, then user can rent a bike
        if (mysqli_num_rows($result) != 0) {
            $_SESSION["bikeName"] = rentABike($_GET["stationId"], $link);
            $link->close();
            header("location: map.php");
        } else {
            echo "A problem has occurred while trying to connect to the DB.";
        }
        $result->close();
    }
} else {
    echo "A problem has occurred during parsing.";
}


//METHODS:
//main method:
function rentABike($stationId, $link)
{
    $bike = getABike($stationId, $link);
    createRental($bike, $stationId, $link);
    $rentalId = getActiveRental($link);

//updates rentalId in user table:
    $sql = "UPDATE user SET rentalId =" . $rentalId . " WHERE id=" . $_SESSION["id"];
    $link->query($sql);
    $link->close();
    
    $_SESSION['active']= $rentalId;

    return $bike[1];
}


//gets a bike from table bike and sets it to 0
function getABike($stationId, $link)
{
    $sql = "SELECT id,name FROM bike WHERE stationId=" . $stationId . " AND free=1";
    if ($result = $link->query($sql)) {
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_row();
            $sql = "UPDATE bike SET free=0 WHERE id=" . $row[0];
            $link->query($sql);
            return $row;
        } else {
            //second check, used for debugging but left it here
            echo "Something went wrong with obtainment.";
        }
        $result->close();
    } else {
        echo "Something went wrong with the DB.";
    }
}

// creates active record in rental table
function createRental($bike, $stationId, $link)
{
    $sql = "INSERT INTO rental (userId, bikeId, dateRented, stationIdFrom) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "iisi", $param_userId, $param_bikeId, $param_dateRented, $param_stationIdFrom);
        $param_userId = $_SESSION["id"];
        $param_bikeId = $bike[0];
        $param_dateRented = date("Y-m-d h:i:s");
        $param_stationIdFrom = $stationId;
        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "Something went wrong during creation of record.";
        }

    } else {
        echo "Something went wrong with the DB during rent of bike.";
    }
}

//gets the id of the rental that is currently active for the current user from the rental table
function getActiveRental($link)
{
    $sql = "SELECT id FROM rental WHERE userId=" . $_SESSION["id"] . " AND active=1";
    if ($result = $link->query($sql)) {
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_row();
        }
        else {
            echo "Something went wrong while processing query.";
        }
        $result->close();
        return $row[0];
    }
    else {
        echo "Something went wrong during obtaining of record.";
    }
}

?>