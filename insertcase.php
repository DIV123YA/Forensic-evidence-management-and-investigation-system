<?php
require("includes/common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

$value = $_SESSION['value'];

$createProcedureSQL = "
CREATE PROCEDURE IF NOT EXISTS viewOfficer()
BEGIN
    SELECT * FROM officer; -- You can modify this query based on your requirements
END;
";

// Run the query to create the procedure
mysqli_multi_query($con, $createProcedureSQL) or die(mysqli_error($con));

$officer = "CALL `viewOfficer`()";
$run_officer = mysqli_query($con, $officer);
?>
<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <meta charset="utf-8">
        <title> Write Report </title>
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
				</ul>
            </nav>
        </aside>
		
						
							
		<div id="main-wrapper">
			
		    <div class="main-content">
				<div class="content-header">
		            <h1> Write Report </h1>
		        </div>
				
				<form action="insert.php" method="POST">
					<section id="Cases">  
		            
		            <div class="features">
		                <h2 class="twenty"> Cases </h2>
		                
		                						
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"> Case Id </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="ccaseid" placeholder="" required="true">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"> Date </label>
								<div class="col-sm-3">
									<input type="date" class="form-control" name="cdate" placeholder="" required="true">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"> Status </label>
								<select Id="myDropdown1" class="btn btn-outline-secondary dropdown-toggle">
									<option> Opened </option>
									<option> Closed </option>
									<option> Pending </option>
									
								</select>
								<input type="text" class="form-control col-sm-1" name="cstatus" id="txtBox1">						
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"> Location </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="caddress" placeholder="" required="true">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-10">
									<button type="submit" name="submit"  class="btn btn-primary btn-lg"> Proceed </button>
								</div>
							</div>
		            </div>

		        </section>		        	       
		        
				</form>
		    </div>
			
			<div class="container-fluid">
					<div style="background-color:black; margin-top:127px" class="row">
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
		
		<script> $("#myDropdown1").change(function () {
				$("#txtBox1").val(this.value);
				}).change();
		</script>
    </body>
</html>
