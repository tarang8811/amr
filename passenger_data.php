<?php
require_once("auth.php");
include "reminder.php";
$flight_data = $_GET["flight_data"];
$selected_index = $_GET["selected_index"];
$number_of_field_required =  (int)$_GET["number_of_field_required"];
?>


<!DOCTYPE HTML>
<html>
<head>
<title>RadheKant | Search</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Green Wheels Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>

<!--- /top-header ---->
<?php if($admin){
	addTopHeader();
}?>
<!--- header ---->
<div class="header">
	<div class="container">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="index.php">RadheKant</a>	
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
	<div class="container">
	<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-1">
						<ul class="nav navbar-nav">
								<li class="active"><a href="index.php">Home</a></li>
								<?php if ($admin) {
									echo '<li ><a href="agent.php">Agent Data Entry Portal</a></li>
											<li ><a href="dashboard_flight.php">Dashboards</a></li>';
								}?>
								<div class="clearfix"></div>
						</ul>
						<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 			
							<li class="sig"><a href="logout.php" >Logout</a></li>
        				</ul>
					</nav>
				</div><!-- /.navbar-collapse -->	
			</nav>
		</div>
		
		<div class="clearfix"></div>
	</div>
</div>
<!--- /bus-tp ---->
<!--- bus-btm ---->
<!-- //signin -->
<!-- write us -->
<div >
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="writ">
										<form  action = "print.php" method = "get">
										<h4>Enter the Name of the Passengers</h4>
											<?php

												$search_result = $flight_data[$selected_index];

												if ($number_of_field_required == 0) {
													$number_of_field_required = $flight_data[$selected_index]["number_of_passenger"];
												}
												for ($j = 1; $j <= $number_of_field_required; $j++) { 
													echo '<p style = "padding-top : 10px">Passenger Number ' . $j . ' </p>';
													echo '<ul>
													  <li class="na-me" style = "width : 80%">
													  	<input class="name" name = "name[]" type="text" placeholder="Name">
												      </li>
													  <div class="clearfix"></div>
													  </ul>';
												}

												
												foreach($search_result as $key => $value){
													echo '<input name = "flight_data[' . $key . ']" value = "' . $value . '" type = "hidden">';
												}

												echo '<input name = "number_of_passenger" value = "' . $search_result["number_of_passenger"] . '" type = "hidden">';
												
											?>

											<div class="sub-bn">
												<button class="subbtn">Print Ticket</button>
											</div>
										</form>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
<!-- //write us -->
</body>
</html>