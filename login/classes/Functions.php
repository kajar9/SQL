<?php

function connect($sql)
{
	$db_connection = null;
	$errors = array();
	$messages = array();
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!$db_connection->set_charset("utf8")) {
                $errors[] = $db_connection->error;
    }
	if (!$db_connection->connect_errno) {
		$locresult = $db_connection->query($sql);
	}	
	return $locresult;	
}

function ImageCount()
{
	$sql = "SELECT *
            FROM `131034_photos`
            WHERE `owner` = " . "'" . $_SESSION['user_name'] . "'" . ";";
	$locresult = connect($sql);
	$numrows = $locresult->num_rows;
	return $numrows;
}

function MyRate($photo_id)
{
	$sql = "SELECT * FROM `131034_ratings` 
	WHERE `user_id` = \"" . $_SESSION['user_id'] . "\" 
	AND `photo_id` = \"" . $photo_id . "\"";
	$locresult = connect($sql);
	$numrows = $locresult->num_rows;
	return $numrows;
}

function getRating($photo_id)
{
	$numrows = 0;
	$sql = "SELECT *
        FROM `131034_ratings`
		WHERE `photo_id` = \"" . $photo_id . "\";";
	$locresult = connect($sql);	
	$numrows = $locresult->num_rows;
	return $numrows;
}

function CommentCount($photo_id)
{
	$sql = "SELECT *
            FROM `131034_comments`
            WHERE `photo_id` = \"" . $photo_id . "\";";
	$locresult = connect($sql);
	$numrows = $locresult->num_rows;
	return $numrows;
}

function UpdatePhotoRating(){
	$sql1 = "SELECT *
            FROM `131034_photos`;";
	$locresult5 = connect($sql1);
	while($locres5=$locresult5->fetch_object()){
		$photoid5=$locres5->id;
		$rating5=getRating($photoid5);
			$sql2 = "UPDATE 131034_photos
					SET `rating`= \"" . $rating5 . "\"
					WHERE `id` = \"" . $photoid5 . "\";";
					connect($sql2);
	}
}

function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }

function getUser($userid){
	$sql="SELECT * FROM `131034_users` WHERE `user_id` = \"" . $userid . "\" LIMIT 1";
		$locresult555 = connect($sql);
		while($res555=$locresult555->fetch_object()){
			return $res555->user_name;
		}
}
	
?>