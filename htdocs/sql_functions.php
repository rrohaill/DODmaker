<?php

function execute_sql_function($query)
{
	$sql_server = "localhost";
	$sql_username = "admin";
	$sql_password = "admin";
	$sql_table = "dodmaker";

	$conn = new mysqli($sql_server, $sql_username, $sql_password, $sql_table);
	$results = $conn->query($query);

	return $results;	
}

function execute_non_query($query)
{
	$sql_server = "localhost";
	$sql_username = "admin";
	$sql_password = "admin";
	$sql_table = "dodmaker";

	$conn = new mysqli($sql_server, $sql_username, $sql_password, $sql_table);
	$sql = $query;

	return mysqli_query($conn, $sql);
}

function return_dod_items_number($id_checklist)
{
	$results = execute_sql_function("SELECT COUNT(question_name) AS 'Number' FROM question WHERE '$id_checklist'=question_checklist");
    if ($row = $results->fetch_assoc())
    	return $row['Number'];
}

?>