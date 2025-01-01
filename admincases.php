<?php
    require("includes/common.php");
    if (!isset($_SESSION['email'])) {
        header('location: index.php');
    }

    $value = $_SESSION['value'];
  // Aggrigate funtn
  
    // Function to get count from a table based on condition
    function getCount($con, $table, $condition) {
        $query = "SELECT COUNT(*) FROM $table";
        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $count = mysqli_fetch_array($result);

        return $count['0'];
    }

    // Get counts using the getCount function
    $c = getCount($con, 'CASES', "STATUS='CLOSED'");
    $o = getCount($con, 'USERS', 'ID>=1000');
    $l = getCount($con, 'LAB', '');

    // Close the database connection
    mysqli_close($con);
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
        <title> Cases </title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
        <!-- CSS -->
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">                    
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/admincases.css">
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
                            Cases   
                        </h1>    
                        <p class="text-white link-nav">
                            <?php
                                if($_SESSION['email']=='admin@fds.com') { ?>
                                    <a href="adminhome.php">                
                            <?php }
                                else if($_SESSION['email']=='officer@fds.com') { ?>
                                    <a href="officerhome.php">                
                            <?php }            
                                else { ?>
                                    <a href="home.php">    
                            <?php } ?>
                            Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="admincases.php"> Cases </a>
                        </p>
                    </div>                                          
                </div>
            </div>
        </section>
        <!-- End banner Area -->    

        <!-- Start simple-services Area -->
        <section class="simple-services-area section-gap">
            <div class="container">                    
                <div class="row">                        
                    <div class="col-lg-6 single-services">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"> Assign Case </h5>
                                <p class="card-text"> Assign Case to Officers </p>
                                <a href="assigncases.php" class="btn btn-primary"> Click  </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>    
            
            
        </section>
        <!-- End simple-services Area -->                

        <!-- Start fact Area -->
        <section class="facts-area section-gap" id="facts-area">
            <div class="container">
                <div class="row">
                    <div class="col single-fact">
                        <h1 class="counter"> <?php echo $c ?> </h1>
                        <p> Cases Completed </p>
                    </div>
                    <div class="col single-fact">
                        <h1 class="counter"> <?php echo $o ?> </h1>
                        <p> Officers </p>
                    </div>
                    <div class="col single-fact">
                        <h1 class="counter"> <?php echo $l ?> </h1>
                        <p> Labs </p>
                    </div>                                                            
                </div>
            </div>    
        </section>
        <!-- end fact Area -->     

        <!-- start footer Area -->    
        <?php
            require 'includes/footer.php';
        ?> 
        <!-- End footer Area -->                     
    </body>
</html>
