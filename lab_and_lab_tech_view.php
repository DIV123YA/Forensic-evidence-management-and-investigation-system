<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$value = $_SESSION['value'];

// Create the 'viewLabAndTech' stored procedure
$createProcedureSQL = "
-- Create the combined procedure
CREATE PROCEDURE IF NOT EXISTS viewLabAndTech()
BEGIN
    -- Fetch Lab and Lab Tech details using LEFT JOIN
    SELECT 
        l.LAB_ID, l.SPECIALIST, l.ADDRESS, 
        lt.TECH_ID, lt.NAME, lt.DESIGNATION
    FROM LAB l
    LEFT JOIN LAB_TECHS lt ON l.TECH_ID = lt.TECH_ID;
END;
";

// Run the query to create the combined procedure
mysqli_multi_query($con, $createProcedureSQL) or die(mysqli_error($con));

// Advance to the next result set
while (mysqli_next_result($con)) {
    if (!mysqli_more_results($con)) {
        break;
    }
}

// Call the combined procedure
$query = "CALL viewLabAndTech()";
$queryResult = mysqli_query($con, $query) or die(mysqli_error($con));
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Lab and Lab Technician Details</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!-- CSS ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- #header -->
<?php
require 'includes/header.php';
?>
<!-- #header -->

<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Lab and Lab Technician Details
                </h1>
            </div>
        </div>
    </div>
</section>
</br>
</br>
<!-- End banner Area -->
<h1> Lab and Lab Technician Details </h1>

<!-- Start Lab and Lab Technician Details Section -->
<section class="simple-services-area section-gap">
    <div class="container">
        <div class="row">
			
            <!-- Display Lab and Lab Tech Details -->
            <?php
            while ($row = mysqli_fetch_assoc($queryResult)) {
                echo '<div class="col-lg-3 single-services">';
                echo '<div class="card text-center" style="width: 18rem;">';

                echo '<div class="card-body">';
                echo '<h5 class="card-title">LAB_ID :' . $row['LAB_ID'] . '</h5>';
                echo '<p class="card-text">TECH_ID :' . $row['TECH_ID'] . '</p>';
                echo '<p class="card-text">SPECIALIST :' . $row['SPECIALIST'] . '</p>';
                echo '<p class="card-text">LAB ADDRESS :' . $row['ADDRESS'] . '</p>';
                echo '<p class="card-text">TECH_NAME :' . $row['NAME'] . '</p>';
                echo '<p class="card-text">DESIGNATION :' . $row['DESIGNATION'] . '</p>';
                echo '</div>';

                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
		</br>
		</br>

<!-- End Lab and Lab Technician Details Section -->

<!-- start footer Area -->
<?php
require 'includes/footer.php';
?>
<!-- End footer Area -->

<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script src="js/easing.min.js"></script>
<!-- Add other scripts as needed -->
<script src="js/main.js"></script>
</body>
</html>
