<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//checks for intruders
if (isset($_SESSION["active"]) and $_SESSION["active"] == 0) {
    header("location: map.php");
    exit;
}
require_once "config.php";

//in case some intruder wants to parse his own string
if (is_numeric($_GET["stationId"]) == "integer") {
    //checking for number of available bikes
    $sql = "SELECT COUNT(*) from bike WHERE stationId=" . $_GET["stationId"] . " AND free = 1";
    if ($result = $link->query($sql)) {
        if (mysqli_num_rows($result) > 0) {
            $available = $result->fetch_row();
            $result->close();
            //checking for capacity of station
            $sql = "SELECT capacity from station WHERE id=" . $_GET["stationId"];
            if ($result = $link->query($sql)) {
                if (mysqli_num_rows($result) == 1) {
                    $capacity = $result->fetch_row();
                    $result->close();
                    //if number of available bikes is smaller than station capacity, then return bike to this station
                    if ($available[0] < $capacity[0]) {
                        $_SESSION["rentalCost"] = returnABike($_GET["stationId"], $link);
                        $link->close();
                        header("location: map.php");
                    } else {
                        echo "Station does not have enough space to park this bike.";
                    }
                } else {
                    echo "Something went wrong with the DB.";
                }
            }
        } else {
            echo "Something went wrong while querying the DB.";
        }
    }

}

//METHODS:
//general method, returns rental cost
function returnABike($stationId, $link)
{
    $rental = getActiveRental($link);

    //sets rental of user to null
    $sql = "UPDATE user SET rentalId = NULL WHERE id=" . $_SESSION["id"];
    $link->query($sql);

    $_SESSION['active'] = 0;

    $rentalNewInfo = makeRentalInactive($rental, $stationId, $link);

    //sets bike to new station and makes it active again:
    $sql = "UPDATE bike SET stationId =" . $stationId . ", free=1 WHERE id=" . $rental[2];
    $link->query($sql);

    return calculateSumOfUser($rentalNewInfo, $link);
}


//returns id, dateRented, bikeId of active rental for current user
function getActiveRental($link)
{
    $sql = "SELECT id, dateRented, bikeId FROM rental WHERE userId=" . $_SESSION["id"] . " AND active = 1";
    if ($result = $link->query($sql)) {
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_row();
            return $row;
        } else {
            echo "Something went wrong while obtaining data from the DB.";
        }
        $result->close();
    } else {
        echo "Something went wrong with processing the DB.";
    }
}

//rental[0] is id, rental[1] is dateRented, rental[2] is bikeId, deactivates the active rental from table rental,
// and updates table,returns timeDifferenceInSeconds and cost of rental
function makeRentalInactive($rental, $stationId, $link)
{

    $dateReturned = date("Y-m-d h:i:s");
    $rental[1] = strtotime($rental[1]);
    $dateReturnedTimestamp = strtotime($dateReturned);
    $differenceInSeconds = $dateReturnedTimestamp - $rental[1];

    $cost = 0;
    $sql = "SELECT station.cost FROM station,bike WHERE station.id = bike.stationId AND bike.id=" . $rental[2];
    if ($result = $link->query($sql)) {
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_row();
            $cost = $row[0];
        } else {
            echo "Something went wrong while obtaining data from the DB.";
        }
        $result->close();
    } else {
        echo "Something went wrong with processing the DB.";
    }
    if ($differenceInSeconds % 3600 != 0) {
        $cost = ((int)(($differenceInSeconds / 60 / 60) + 1)) * $cost;
    } else {
        $cost = ($differenceInSeconds / 60 / 60) * $cost;
    }
    $sql = "UPDATE rental SET active=0, dateReturned='" . $dateReturned . "',cost=" . $cost . " ,stationIdTo=" . $stationId . " WHERE id=" . $rental[0];
    $link->query($sql);

    $rentalNewInfo = array();
    $rentalNewInfo[] = $cost;
    $rentalNewInfo[] = $differenceInSeconds;
    return $rentalNewInfo;

}

//calculates time and cost of rental and adds them to sum of user
function calculateSumOfUser($rental, $link)
{
    $rentalCost = $rental[0];
    $timeDifferenceInSeconds = $rental[1];
    $timeSum = 0;
    $costSum = 0;

    $sql = "SELECT timeSum,costSum FROM user WHERE id=" . $_SESSION["id"];
    if ($result = $link->query($sql)) {
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_row();
            $timeSum = $row[0];
            $costSum = $row[1];
        } else {
            echo "Something went wrong while obtaining data from the DB.";
        }
        $result->close();
    } else {
        echo "Something went wrong with processing the DB.";
    }
    $costSum = $costSum + $rentalCost;
    $timeSum = $timeSum + $timeDifferenceInSeconds;

    $sql = "UPDATE user SET timeSum=" . $timeSum . " , costSum=" . $costSum . " WHERE id=" . $_SESSION["id"];
    $link->query($sql);
    return $rentalCost;
}

?>