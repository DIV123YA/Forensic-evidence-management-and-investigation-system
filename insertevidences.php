<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$value = $_SESSION['value'];

$ccaseid = $_SESSION['ccaseid'];

if (isset($_POST["insert"])) {
    $ecaseid = $_POST['ecaseid'];
    $elabid = $_POST['elabid'];
    $ephotodate = $_POST['ephotodate'];
    $eprocessingmethod = $_POST['eprocessingmethod'];

    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $file2 = addslashes(file_get_contents($_FILES["image2"]["tmp_name"]));
    $query = "INSERT INTO EVIDENCE (CASE_ID, LAB_ID, PHOTO, FINGERPRINT, PHOTO_DATE, PROCESSING_METHOD) VALUES('$ecaseid','$elabid','$file','$file2','$ephotodate','$eprocessingmethod')";
    if (mysqli_query($con, $query)) {
        echo "<script>if(confirm('Insertion Successful! Proceed Next -->')){document.location.href='insertfirearms.php'};</script>";
    } else {
        $message = "Couldn't insert values! Please try again!";
        echo "<script>if(confirm('$message')){document.location.href='insertevidences.php'};</script>";
    }
}

$officer = "CALL `viewOfficer`()";
$run_officer = mysqli_query($con, $officer);

// Error handling for the query execution
if (!$run_officer) {
    die('Error: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Write Report</title>
    <meta name="description" content="">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>
    <!-- Syntax Highlighter -->
    <link rel="stylesheet" type="text/css" href="syntax-highlighter2/styles/shCore.css" media="all">
    <link rel="stylesheet" type="text/css" href="syntax-highlighter2/styles/shThemeDefault.css" media="all">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="css2/font-awesome.min.css">
    <!-- Normalize/Reset CSS-->
    <link rel="stylesheet" href="css2/normalize.min.css">
    <!-- Main CSS-->
    <link rel="stylesheet" href="css2/main.css">
</head>

<body id="welcome">

<aside class="left-sidebar">
    <div class="logo">
        <a href="#welcome">
            <img style="height:40px; width:50px" src="img/logo.jpg" alt="">
        </a>
    </div>
    <nav class="left-nav">
        <ul id="nav">
            <li><a href="#Evidences" style="text-decoration: none;">Evidences</a></li>
        </ul>
    </nav>
</aside>

<!-- Modal -->
<div class="modal fade" style="padding-top:10%;" id="myModal" role="dialog">
    <!-- ... (unchanged) ... -->
</div>
<!-- Modal -->

<div id="main-wrapper">
    <div class="main-content">
        <div class="content-header">
            <h1>Write Report</h1>
        </div>

        <form action="capture.php" method="POST" enctype="multipart/form-data">
            <section id="Evidences">
                <h2 class="title">Evidences</h2>

                <div class="form-group row">
                    <!-- ... (unchanged) ... -->
                </div>

                <div class="form-group row">
                    <!-- ... (unchanged) ... -->
                </div>

                <div class="form-group row">
                    <!-- ... (unchanged) ... -->
                </div>

                <div class="form-group row">
                    <!-- ... (unchanged) ... -->
                </div>

                <div class="form-group row">
                    <!-- ... (unchanged) ... -->
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="insert" class="btn btn-primary btn-lg">Proceed</button>
                    </div>
                </div>
            </section>
        </form>
    </div>

    <div class="container-fluid">
        <div style="background-color:black; margin-top:183px" class="row">
            <!-- ... (unchanged) ... -->
        </div>
    </div>
</div>

<!-- ... (unchanged) ... -->

</body>
</html>
