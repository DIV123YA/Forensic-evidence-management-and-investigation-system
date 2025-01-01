<?php
require("includes/common.php");

if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$value = $_SESSION['value'];

$viewcase = isset($_POST['viewcase']) ? $_POST['viewcase'] : null;
if (!$viewcase) {
    header('location: allcases.php');
}

// Use JOIN operations to retrieve data from multiple tables
$query = "SELECT 
            C.CASE_ID, C.OFFICER_ID, C.DATE, C.STATUS,
            S.SUSPECT_ID, S.ADDRESS AS SUSPECT_ADDRESS,
            K.KNOWN_ID, K.DNA_RESULT, K.DRUG_TEST_RESULT, K.BALLISTICS_RESULT, K.BLOOD_GROUP,
            F.EVIDENCE_ID, F.COLLECTING_OFFICER, F.LAB_ID, F.RECEIVING_METHOD, F.RECEIVED_DATE, F.LOCATION_FOUND, F.ADDRESS AS EVIDENCE_ADDRESS
          FROM CASES C
          LEFT JOIN SUSPECTS S ON C.CASE_ID = S.CASE_ID
          LEFT JOIN KNOWN_FORENSICS K ON C.CASE_ID = K.CASE_ID
          LEFT JOIN forensic_evidence F ON C.CASE_ID = F.CASE_ID
          WHERE C.CASE_ID = '$viewcase'";


$run_query = mysqli_query($con, $query);
$result = mysqli_fetch_array($run_query);

if (!$result) {
    if ($_SESSION['email'] == 'admin@fds.com') {
        echo "<script>if(confirm('Case Is Not Available!')){document.location.href='officerhome.php'};</script>";
    } else {
        echo "<script>if(confirm('Case Is Not Available!')){document.location.href='officerhome.php'};</script>";
    }
}

$name = "SELECT NAME
        FROM USERS
        WHERE EMAIL = '" . $_SESSION['email'] . "' ";
$run_name = mysqli_query($con, $name);
$name_r = mysqli_fetch_array($run_name);
?>




<!DOCTYPE html>
<html class="no-js"> 
<head>
    <meta charset="utf-8">
    <title> CASE </title>
    <meta name="description" content="">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- <link rel="shortcut icon" href="img/favicon.png"> -->
    
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
            <li class="current"><a href="#Cases" style="text-decoration: none;"> Cases </a></li>
            <li><a href="#Suspects" style="text-decoration: none;"> Suspects </a></li>
            <li><a href="#Known-Forensics" style="text-decoration: none;"> Known Forensics </a></li>
        </ul>
    </nav>
</aside>
        
<div id="main-wrapper">
            
<div class="main-content">
    <div class="content-header">
        <h1> CASE <?php echo $viewcase ?> </h1>
    </div>
    
    <form>
        <section id="Cases">  
            <div class="features">
                <h3 class="twenty"> Cases </h3>
                <div class="form-group row">
                    <label class="col-form-label tab"> Case Id : <?php echo $result['CASE_ID'] ?></label>                                                                
                </div>
                <div class="form-group row">
                    <label class="col-form-label tab"> Officer Id : <?php echo $result['OFFICER_ID'] ?></label>                            
                </div>
                <div class="form-group row">
                    <label class="col-form-label tab"> Date : <?php echo $result['DATE'] ?></label>
                </div>
                <div class="form-group row">
                    <label class="col-form-label tab"> Status : <?php echo $result['STATUS'] ?></label>
                </div>
            </div>
        </section>

        <section id="Suspects">
    <h3 class="title"> Suspects </h3>
    <div class="form-group row">
        <label class="col-form-label tab"> Suspect Id : <?php echo isset($result['SUSPECT_ID']) ? $result['SUSPECT_ID'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Case Id : <?php echo isset($result['CASE_ID']) ? $result['CASE_ID'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Address :<?php echo isset($result['SUSPECT_ADDRESS']) ? $result['SUSPECT_ADDRESS'] : 'N/A' ?></label>
    </div>
</section>

<section id="Known-Forensics">
    <h3 class="title"> Known Forensics </h3>
    <div class="form-group row">
        <label class="col-form-label tab"> Known Id : <?php echo isset($result['KNOWN_ID']) ? $result['KNOWN_ID'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Case Id : <?php echo isset($result['CASE_ID']) ? $result['CASE_ID'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> DNA Result : <?php echo isset($result['DNA_RESULT']) ? $result['DNA_RESULT'] : 'N/A' ?> </label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Drug Test Result : <?php echo isset($result['DRUG_TEST_RESULT']) ? $result['DRUG_TEST_RESULT'] : 'N/A' ?></label>
    </div>
   
    <div class="form-group row">
        <label class="col-form-label tab"> Blood Group : <?php echo isset($result['BLOOD_GROUP']) ? $result['BLOOD_GROUP'] : 'N/A' ?></label>
    </div>
</section>

<!-- Add the following code inside the appropriate sections of your HTML -->

<section id="Forensic-Evidence">
    <h3 class="title"> Forensic Evidence </h3>
    <div class="form-group row">
        <label class="col-form-label tab"> Evidence Id : <?php echo isset($result['EVIDENCE_ID']) ? $result['EVIDENCE_ID'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Collecting Officer : <?php echo isset($result['COLLECTING_OFFICER']) ? $result['COLLECTING_OFFICER'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Lab Id : <?php echo isset($result['LAB_ID']) ? $result['LAB_ID'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Receiving Method : <?php echo isset($result['RECEIVING_METHOD']) ? $result['RECEIVING_METHOD'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Received Date : <?php echo isset($result['RECEIVED_DATE']) ? $result['RECEIVED_DATE'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Location Found : <?php echo isset($result['LOCATION_FOUND']) ? $result['LOCATION_FOUND'] : 'N/A' ?></label>
    </div>
    <div class="form-group row">
        <label class="col-form-label tab"> Evidence Address : <?php echo isset($result['EVIDENCE_ADDRESS']) ? $result['EVIDENCE_ADDRESS'] : 'N/A' ?></label>
    </div>
</section>


        <p style="margin-left:800px"> Signature </p>
        <p style="margin-left:810px"> <?php echo isset($name_r[0]) ? "(" . $name_r[0] . ")" : 'N/A' ?> </p>

        <button onclick="myFunction()" type="print" name="print" class="btn btn-primary btn-sm"> Print </button>

        <script>
            function myFunction() {
                window.print();
            }
        </script>

        <style>
            .tab {position:relative;left:50px; }
        </style>

        <style type="text/css" media="print">
            @page {
                size: auto;  
                margin: 0;    
            }
        </style>
    </form>
</div>

<div class="container-fluid">
    <div style="background-color:black" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <div class="single-footer-widget">
                <h6 class="text-white"> Forensic Department </h6>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Essential JavaScript Libraries
==============================================-->
<script type="text/javascript" src="js2/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js2/jquery.nav.js"></script>
<script type="text/javascript" src="syntax-highlighter2/scripts/shCore.js"></script> 
<script type="text/javascript" src="syntax-highlighter2/scripts/shBrushXml.js"></script> 
<script type="text/javascript" src="syntax-highlighter2/scripts/shBrushCss.js"></script> 
<script type="text/javascript" src="syntax-highlighter2/scripts/shBrushJScript.js"></script> 
<script type="text/javascript" src="syntax-highlighter2/scripts/shBrushPhp.js"></script> 
<script type="text/javascript">
    SyntaxHighlighter.all()
</script>
<script type="text/javascript" src="js2/custom.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
</body>
</html>
