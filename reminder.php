<?php


function returnAllRemindersData(){
	include "query.php";

	$reminder_array = array();
	$reminder_results = getFlightReminderData();
	foreach ($reminder_results["result"] as $reminder_result) {
		$reminder_days = $reminder_result["reminder_days"];
		//echo date("Y-m-d", strtotime($reminder_result["date"])) . " " . date('Y-m-d') . "\n";
		$flight_date = new DateTime(date("Y-m-d", strtotime($reminder_result["date"])));

		date_default_timezone_set('Asia/Kolkata'); // CDT
		$current_date = new DateTime(date('Y-m-d'));	

		$diff = date_diff($current_date, $flight_date)->format("%R%a");
		//echo $diff . " ";

		if ($diff <= (int)$reminder_result["reminder_days"]) {
			$flight_data = ["id" => $reminder_result["id"],
							"flight_name" => $reminder_result["flight_name"],
							"flight_number" => $reminder_result["flight_number"],
							"origin" => $reminder_result["origin"],
							"destination" => $reminder_result["destination"],
							"price" => $reminder_result["price"],
							"date" => $reminder_result["date"],
							"time" => $reminder_result["time"],
							"time_arr" => $reminder_result["time_arr"],
							"number_of_passenger" => $reminder_result["number_of_passenger"],
							"PNR" => $reminder_result["PNR"],
							];
			array_push($reminder_array, $flight_data);
		}
	}
	return ['status' => 'ok' , 'result' => $reminder_array];
}


function addTopHeader(){

	$result = returnAllRemindersData();
	if (count($result["result"]) > 0) {
		echo '<div class="top-header" style = "background-color : #FF0000" >
				<div class="container">
					<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s" >
						<li class="hm"><a href="dashboard_reminder.php"><i class="fa fa-home"></i></a></li>
						<li class="prnt"><a href="dashboard_reminder.php">You have '. count($result["result"]) .' reminders</a></li>
					</ul>
				<div class="clearfix"></div>
				</div>
			</div>';
	}
}