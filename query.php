<?php

function insert($table_name, $params){
	include "connect.php";
	$columns_name = "";
	$values = "";
	foreach ($params as $key => $value) {
		$columns_name = $columns_name . $key . ", ";
		$values = $values . "'" . $value . "', ";
	}
	$columns_name = rtrim($columns_name, ", ");
	$values  = rtrim($values, ", ");
	$sql_query =  "INSERT INTO " . $table_name . " (" . $columns_name . ") VALUES (" . $values . ")";
		if ($con->query($sql_query) === TRUE) {
   			 return "success";
		} else {
			//return "error";
   			return "Error: " . $sql_query . "<br>" . $con->error;
		}
 
}

function searchWithCondition($table_name, $columns, $keys, $values){
	include 'connect.php';
	$column_name = "";

	$condition = "";
	for ($i = 0 ; $i < count($keys) ; $i++){
		if ($keys[$i] == "number_of_passenger") {
				$condition = $condition . $keys[$i] . " >= " . $values[$i] . " ";
		}else{
			if ($i == count($keys) - 1) {
				$condition = $condition . $keys[$i] . " = '" . $values[$i] . "' ";
			}else{
				$condition = $condition . $keys[$i] . " = '" . $values[$i] . "' AND ";
			}
		}
			
	}

	if (count($columns) > 0) {
		foreach ($columns as $column) {
			$columns_name = $columns_name . $column . ", ";
		}

		$columns_name = rtrim($columns_name, ", ");
		$sql_query = "SELECT " . $columns_name ." FROM " . $table_name . " WHERE " . $condition . "ORDER BY number_of_passenger DESC";
	}else{
		$sql_query = "SELECT * FROM " . $table_name . " WHERE " . $condition . "ORDER BY number_of_passenger DESC";
	}

	return queryAndGetData($con, $sql_query);
	
	
}


function searchWithConditionReturn($table_name, $columns, $keys, $values){
	include 'connect.php';
	$column_name = "";

	$condition = "";
	for ($i = 0 ; $i < count($keys) ; $i++){
		if ($keys[$i] == "number_of_passenger") {
				$condition = $condition . $keys[$i] . " >= " . $values[$i] . " ";
		}else{

			if ($keys[$i] == "origin") {
				$condition = $condition . "(". $keys[$i] . " = '" . $values[$i] . "' || " . $keys[$i] . " = '" . $values[$i + 1] . "') AND ";
			}else if($keys[$i] == "destination"){
				if(count($keys) > 2){
					$condition = $condition . "(". $keys[$i] . " = '" . $values[$i] . "' || " . $keys[$i] . " = '" . $values[$i - 1] . "') AND ";
				}else{
					$condition = $condition . "(". $keys[$i] . " = '" . $values[$i] . "' || " . $keys[$i] . " = '" . $values[$i - 1] . "')";
				}
				
			}else{
				if ($i == count($keys) - 1) {
					$condition = $condition . $keys[$i] . " = '" . $values[$i] . "' ";
				}else{
					$condition = $condition . $keys[$i] . " = '" . $values[$i] . "' AND ";
				}
			}
			
		}
			
	}

	if (count($columns) > 0) {
		foreach ($columns as $column) {
			$columns_name = $columns_name . $column . ", ";
		}

		$columns_name = rtrim($columns_name, ", ");
		$sql_query = "SELECT " . $columns_name ." FROM " . $table_name . " WHERE " . $condition . "ORDER BY number_of_passenger DESC";
	}else{
		$sql_query = "SELECT * FROM " . $table_name . " WHERE " . $condition . "ORDER BY number_of_passenger DESC";
	}
	echo $sql_query;
	return queryAndGetData($con, $sql_query);
	
	
}


function search($table_name, $columns, $key, $value){
	include 'connect.php'; 
	$column_name = "";
	if (count($columns) > 0) {
		foreach ($columns as $column) {
			$columns_name = $columns_name . $column . ", ";
		}
		$columns_name = rtrim($columns_name, ", ");
		$sql_query = "SELECT " . $columns_name ." FROM " . $table_name . " WHERE " . $key . "=" . "'" . $value . "'" . "ORDER BY number_of_passenger DESC";
	}else{
		$sql_query = "SELECT * FROM " . $table_name . " WHERE " . $key . "=" . "'" . $value . "'" . "ORDER BY number_of_passenger DESC";
	}

	return queryAndGetData($con, $sql_query);
	
	
}


function searchLessThan($table_name, $columns, $key, $value){
	include 'connect.php';
	$sql_query =  
	$column_name = "";
	if (count($columns) > 0) {
		foreach ($columns as $column) {
			$columns_name = $columns_name . $column . ", ";
		}
		$columns_name = rtrim($columns_name, ", ");
		$sql_query = "SELECT " . $columns_name ." FROM " . $table_name . " WHERE " . $key . "<=" . "'" . $value . "'" . "ORDER BY number_of_passenger DESC";
	}else{
		$sql_query = "SELECT * FROM " . $table_name . " WHERE " . $key . "<=" . "'" . $value . "'" . "ORDER BY number_of_passenger DESC";
	}

	return queryAndGetData($con, $sql_query);
}

function updateColumnWithId($table_name, $id , $column , $value){
	include 'connect.php';
	$sql_query = "UPDATE " . $table_name . " SET " . $column . " = " . $value . " WHERE id = " . $id;

	if ($con->query($sql_query) === TRUE) {
   			 return "success";
		} else {
   			return "Error: " . $sql_query . "<br>" . $con->error;
		}
}

function updateTableWithId($table_name, $id , $columns , $values){
	include 'connect.php';
	$sql_query = "UPDATE " . $table_name . " SET ";
	if (count($columns) > 0) {
		for ($i = 0; $i < count($columns); $i++) { 
			$sql_query = $sql_query . $columns[$i] . " = '" . $values[$i] . "' , ";
		}
		$sql_query = rtrim($sql_query, ", ");
		$sql_query = $sql_query . "WHERE id = " . $id;
	}else{
		return "Error: columns paramter empty";
	}

	if ($con->query($sql_query) === TRUE) {
   			 return "success";
		} else {
   			return "Error: " . $sql_query . "<br>" . $con->error;
		}
}

function updateTableWithCondition($table_name, $condition , $columns , $values){
	include 'connect.php';
	$sql_query = "UPDATE " . $table_name . " SET ";
	if (count($columns) > 0) {
		for ($i = 0; $i < count($columns); $i++) { 
			$sql_query = $sql_query . $columns[$i] . " = '" . $values[$i] . "' , ";
		}
		$sql_query = rtrim($sql_query, ", ");
		$sql_query = $sql_query . " WHERE " . $condition["key"] . " = '" . $condition["value"] . "'";
	}else{
		return "Error: columns paramter empty";
	}

	if ($con->query($sql_query) === TRUE) {
   			 return "success";
		} else {
   			return "Error: " . $sql_query . "<br>" . $con->error;
		}
}


function deleteColumnWithId($table_name, $id){
	include 'connect.php';
	$sql_query = "DELETE FROM " . $table_name . " WHERE id = " . $id;

	if ($con->query($sql_query) === TRUE) {
   			 return "success";
		} else {
   			return "Error: " . $sql_query . "<br>" . $con->error;
		}
}

function searchGreaterThan($table_name, $columns, $key, $value){
	include 'connect.php';
	$column_name = "";
	if (count($columns) > 0) {
		foreach ($columns as $column) {
			$columns_name = $columns_name . $column . ", ";
		}
		$columns_name = rtrim($columns_name, ", ");
		$sql_query = "SELECT " . $columns_name ." FROM " . $table_name . " WHERE " . $key . " >= " . $value . " dashboard_reminder.php";
	}else{
		$sql_query = "SELECT * FROM " . $table_name . " WHERE " . $key . " >= " . $value . " ORDER BY number_of_passenger DESC";
	}

	return queryAndGetData($con, $sql_query);
}

function searchAll($table_name){
	include 'connect.php';
	$sql_query =  "SELECT * FROM " . $table_name . " ORDER BY number_of_passenger DESC";

	return queryAndGetData($con, $sql_query);
	
}

function getFlightReminderData(){
	include 'connect.php';
	$sql_query =  "SELECT fd.*, frt.reminder_days FROM flight_data fd JOIN flight_reminder_time frt ON fd.flight_name = frt.flight_name ORDER BY number_of_passenger DESC";
	return queryAndGetData($con, $sql_query);
}


function searchAllWithoutCondition($table_name){
	include 'connect.php';
	$sql_query =  "SELECT * FROM " . $table_name ;

	return queryAndGetData($con, $sql_query);
	
}

function queryAndGetData($con, $sql_query){

	if ($result = $con->query($sql_query)) {
		if ($result->num_rows > 0) {
			$data = array();
			while($row = $result->fetch_assoc()) {
       			array_push($data, $row);
   			 }
			return ['status' => 'ok' , 'result' => $data];
		}else{
			$message = "Error: " . $sql_query . "<br>" . $con->error;
			return ['status' => 'error', 'message' => $message];
			//return ['status' => 'Error' , 'message' => 'Data not found'];
		}
		return $result;
	}else{
		$message = "Error: " . $sql_query . "<br>" . $con->error;
		return ['status' => 'error', 'message' => $message];
	}

}








