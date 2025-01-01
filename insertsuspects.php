<?php
require("includes/common.php");

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $scaseid = mysqli_real_escape_string($con, $_POST["scaseid"]);
    $sname = mysqli_real_escape_string($con, $_POST["sname"]);
    $saddress = mysqli_real_escape_string($con, $_POST["saddress"]);

    // Perform form validation (you can customize this based on your requirements)
    if (empty($scaseid) || empty($sname) || empty($saddress)) {
        $message = "All fields are required.";
        echo "<script>if(confirm('$message')){document.location.href='insertsuspects.php'};</script>";
        exit;
    }

    // Insert data into the SUSPECTS table
    $query = "INSERT INTO SUSPECTS (CASE_ID, NAME, ADDRESS) VALUES ('$scaseid', '$sname', '$saddress')";
    
    if (mysqli_query($con, $query)) {
        echo "<script>if(confirm('Insertion Successful! Proceed Next -->')){document.location.href='officerhome.php'};</script>";
    } else {
        $message = "Couldn't insert values! Please try again.";
        echo "<script>if(confirm('$message')){document.location.href='insertsuspects.php'};</script>";
    }
}
?>

<!-- HTML Form for Inserting Suspects -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Suspects</title>
</head>
<body>

    <h2>Insert Suspects</h2>

    <form action="insertsuspects.php" method="POST">
        <label for="scaseid">Case ID:</label>
        <input type="number" name="scaseid" required>
</br>
</br>
</br>
        <label for="sname">Name:</label>
        <input type="text" name="sname" required>
</br>
</br>
</br>
        <label for="saddress">Address:</label>
        <input type="text" name="saddress" required>
        </br>
</br>
</br>
        <button type="submit" name="insert">Insert</button>
    </form>

</body>
</html>
