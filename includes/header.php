<header id="header" id="home">
			  	<hr>
			    <div class="container">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="home.php"><img style="height:60px; width:60px" src="img/logo.jpg" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
						<?php
							if($_SESSION['user_id']>=1 && $_SESSION['user_id']<=99) { ?>
							    <li class="menu-active"><a href="newhome.php"> Home </a></li>
								<li class="menu-active"><a href="adminhome.php"> User_Details </a></li>
								<li><a href="admincases.php"> Assign_Case </a></li>
								<li><a href="logout_script.php"> Log Out </a></li>
						<?php }
							
							else if($_SESSION['user_id']>=100 && $_SESSION['user_id']<=999) { ?>
								<li class="menu-active"><a href="home.php"> Home </a></li>
								<li><a href="departments.php"> Departments </a></li>
								<li><a href="forensiccases.php"> Case Analysis </a></li>
								<li><a href="logout_script.php"> Log Out </a></li>								
							<?php }
							
							else { ?>
								<li class="menu-active"><a href="officerhome.php"> Officer_Home </a></li>
								<li><a href="logout_script.php"> Log Out </a></li>
						<?php } ?>
			
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
</header><!-- #header -->