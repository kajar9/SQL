<?php

function ImageCount()
{
	$db_connection = null;
	$errors = array();
	$messages = array();
	$user_name = "'" . $_SESSION['user_name'] . "'";
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!$db_connection->set_charset("utf8")) {
                $errors[] = $db_connection->error;
    }
	if (!$db_connection->connect_errno) {
		$sql = "SELECT *
                FROM `131034_photos`
                WHERE `owner` = " . $user_name . ";";
		$result = $db_connection->query($sql);
		$res = $result->num_rows;
	}	
	return $res;	
}

?>
