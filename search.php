<?php
require_once("auth.php");
include "query.php";

$keys = array();
$values = array();
$result = array();

if (!empty($_GET['origin'])) {
	array_push($keys, "origin");
	array_push($values, $_GET['origin']);
}
if (!empty($_GET['destination'])) {
	array_push($keys, "destination");
	array_push($values, $_GET['destination']);
}
if (!empty($_GET['date'])) {
	array_push($keys, "date");
	array_push($values, $_GET['date']);
}
if (!empty($_GET['number_of_passenger'])) {
	array_push($keys, "number_of_passenger");
	array_push($values, $_GET['number_of_passenger']);
}

if (!empty($_GET['selected_radio'])) {
	$selection = $_GET['selected_radio'];
	if ($selection == "one_way") {
		$result = searchWithCondition("flight_data", [], $keys, $values);
	}else{
		if (!empty($_GET['return_date'])) {
			array_push($keys, "return_date");
			array_push($values, $_GET['return_date']);
			if (!empty($_GET['destination']) && !empty($_GET['origin'])) {
			$unformatted_result = searchWithConditionReturn("flight_data", [], $keys, $values);
			if (count($unformatted_result["result"]) > 0) {
				$result = formatresult($unformatted_result["result"], $_GET['date'], $_GET['return_date'], $_GET['origin'], $_GET['destination']);
			}
			
			}
		}
		
	}
}

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
<div class="bus-btm">
	<div class="container">
		<ul>
			<li class="trav" style = "width : 22%"><a href="#">Flight</a></li>
			<li class="dept" style = "width : 13%"><a href="#">PNR</a></li>
			<li class="dept" style = "width : 13%"><a href="#">Date-Time</a></li>
			<li class="dept" style = "width : 13%"><a href="#">Origin</a></li>
			<li class="dept" style = "width : 13%"><a href="#">Destination</a></li>
			<li class="dept" style = "width : 13%"><a href="#">Number of Passenger</a></li>
			<li class="dept" style = "width : 13%"><a href="#">Price</a></li>
				<div class="clearfix"></div>
		</ul>
	</div>
</div>
<!--- /bus-btm ---->
<!--- bus-midd ---->
<div class="bus-midd wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
	<div class="container">
	<!--- ul-first  ---->
		<ul class="first">
		<?php 

		if ($result["status"] == "ok") {
				$j = 0;
				foreach ($result["result"] as $search_result) {
		
		echo '<div style = "padding-top : 20px">';
		echo '	<li class="trav" style = "width : 22% ; padding-top : 10px">

					<h4>' . $search_result["flight_name"] . ' </h4>
					<p> ' . $search_result["flight_number"] .'</p>
				<div class="clearfix"></div>
				</li>';

		echo '  <li class="dept" style = "width : 13%">
					<h4>' . $search_result["PNR"] . '</h4>
				<div class="clearfix"></div>
				</li>';


		echo '	<li class="dept" style = "width : 13%">
					<h4><a href="#">'. date("jS M, Y", strtotime($search_result["date"])) . '</a></h4>
					<p> Dep : ' . $search_result["time"] . '</p>
					<p> Arr : ' . $search_result["time_arr"] . '</p>
				<div class="clearfix"></div>
				</li>';

		echo '	<li class="dept" style = "width : 13%">
				<div class="bus-txt2">
					<h4><a href="#">' . $search_result["origin"] . '</a></h4>
				</div>
				</li>';

		echo '	<li class="dept" style = "width : 13%">
				<div class="bus-txt2">
					<h4><a href="#">' . $search_result["destination"] . '</a></h4>
				</div>
				</li>';

		echo '  <li class="dept" style = "width : 13%">
				<div class="bus-txt3">
					<h4>' . $search_result["number_of_passenger"] . '</h4>
				</div>
				<div class="clearfix"></div>
				</li>';


		echo '	<li class="dept" style = "width : 13%">
				<div class="bus-txt4">
					<h5> ₹ ' . $search_result["price"] . '</h4>

					<form action = "passenger_data.php" method = "get">';
					$i = 0;
					foreach ($result["result"] as $search_result) {
						foreach($search_result as $key => $value){
						echo '<input name = "flight_data['. $i.'][' . $key . ']" value = "' . $value . '" type = "hidden">';
						}
						$i++;
					}
		echo '     <input name = "selected_index" type = "hidden" value = "' . $j . '">
					<input name = "number_of_field_required" type = "hidden" value = "'; 

					if (!empty($_GET['number_of_passenger'])) {
						echo $_GET['number_of_passenger'];
					}else{
						echo '0';
					}
	

		echo'       ">
					<input  style = "margin-top: 10px;" type="submit" value="Book">
					</form>
				</div>
				</li>';

		echo ' <div class="clearfix"></div>';
		echo '</div>';

		$j++;
		}
		}else{
			echo 'No Results Found, Please Try Again';
			echo '<div class="ag-bt" style = "padding-top : 10px">
				<a class="regist" href="index.php">Retry</a>
			</div>';
		}

		
		?>
		</ul>
	</div>
</div>
<!--- /bus-midd ---->
<!--- footer-top ---->
<!--- /footer-top ---->
<!---copy-right ---->
<div class="copy-right">
	<div class="container">
	
		<div class="footer-social-icons wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
			<ul>
				<li><a class="facebook" href="#"><span>Facebook</span></a></li>
				<li><a class="twitter" href="#"><span>Twitter</span></a></li>
				<li><a class="flickr" href="#"><span>Flickr</span></a></li>
				<li><a class="googleplus" href="#"><span>Google+</span></a></li>
				<li><a class="dribbble" href="#"><span>Dribbble</span></a></li>
			</ul>
		</div>
		<p class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">© 2016 RadheKant . All Rights Reserved .</p>
	</div>
</div>
<!--- /copy-right ---->
<!-- sign -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<ul>
													<li><a class="fb" href="#"><i></i>Sign in with Facebook</a></li>
													<li><a class="goog" href="#"><i></i>Sign in with Google</a></li>
													<li><a class="linkin" href="#"><i></i>Sign in with Linkedin</a></li>
												</ul>
											</div>
											<div class="login-right">
												<form>
													<h3>Create your account </h3>
													<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
													<input type="text" value="Mobile number" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mobile number';}" required="">
													<input type="text" value="Email id" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email id';}" required="">	
													<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">	
													<input type="submit" value="CREATE ACCOUNT">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
											<p>By logging in you agree to our <a href="terms.html">Terms and Conditions</a> and <a href="privacy.html">Privacy Policy</a></p>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
<!-- //sign -->
<!-- signin -->
		<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-left">
										<ul>
											<li><a class="fb" href="#"><i></i>Sign in with Facebook</a></li>
											<li><a class="goog" href="#"><i></i>Sign in with Google</a></li>
											<li><a class="linkin" href="#"><i></i>Sign in with Linkedin</a></li>
										</ul>
									</div>
									<div class="login-right">
										<form>
											<h3>Signin with your account </h3>
											<input type="text" value="Enter your mobile number or Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your mobile number or Email';}" required="">	
											<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">	
											<h4><a href="#">Forgot password</a></h4>
											<div class="single-bottom">
												<input type="checkbox" id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>
											<input type="submit" value="SIGNIN">
										</form>
									</div>
									<div class="clearfix"></div>								
								</div>
								<p>By logging in you agree to our <a href="terms.html">Terms and Conditions</a> and <a href="privacy.html">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- //signin -->
<!-- //write us -->
</body>
</html>
