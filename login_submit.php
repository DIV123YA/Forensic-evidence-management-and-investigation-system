<?php
require("includes/common.php");

$email = $_POST['e-mail'];
$password = $_POST['password'];

// Check if the connection is successful
if ($con) {
    $query = "SELECT ID, NAME, EMAIL FROM USERS WHERE EMAIL='" . $email . "' AND password='" . $password . "'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $num = mysqli_num_rows($result);

    if ($num == 0) {
        header('location: failed.php');
    } else {
        $row = mysqli_fetch_array($result);

        $_SESSION['email'] = $row['EMAIL'];
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['name'] = $row['NAME'];

        $email = $_SESSION['email'];
        $value = rand();
        $_SESSION['value'] = $value;
        $accesslog = "INSERT INTO ACCESSLOGS(ID, USER, LOGGEDIN) VALUES ('$value', '$email', NOW())";
        $run_accesslog = mysqli_query($con, $accesslog) or die(mysqli_error($con));

        header('location: success.php');
    }
} else {
    // Handle the case where the connection is not successful
    die("Connection failed: " . mysqli_connect_error());
}
?>